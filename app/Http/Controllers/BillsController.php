<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{
    protected function current_bill($request)
    {
        $couple = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        if ($couple !== null) {
            // get latest amount due of a selected invoice
            $couple_bill = Bills::where('couple_id', $couple->id)->where('name', $request->name)->latest()->first();

            $individual_bill = Bills::where('user_id', auth()->user()->id)->where('name', $request->name)->latest()->first();

            if ($couple_bill !== null) {
                if ($individual_bill !== null) {
                    if ($couple_bill->created_at > $individual_bill->created_at) {
                        return $couple_bill;
                    } else {
                        return $individual_bill;
                    }
                } else {
                    return $couple_bill;
                }
            } else {

                return Bills::where('user_id', auth()->user()->id)->where('name', $request->name)->latest()->first();
            }
        } else {
            return Bills::where('user_id', auth()->user()->id)->where('name', $request->name)->latest()->first();
        }
    }
    // Get bills 
    public function index(Request $request)
    {
        // Get couple id
        $couple_id = DB::table('couple')->select('id')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        if ($couple_id !== null) {
            // Get due dates
            $dates = Bills::select('date_due')->where('user_id', auth()->user()->id)->where('name', $request->name)->orWhere('couple_id', $couple_id->id)->where('name', $request->name)->distinct()->get();
        } else {
            // Get due dates
            $dates = Bills::select('date_due')->where('name', $request->name)->where('user_id', auth()->user()->id)->distinct()->get();
        }


        $bills = array();
        $newArr = array();
        // Loop through each date
        foreach ($dates as $date) {

            if ($couple_id !== null) {
                $newBills = Bills::where('name', $request->name)->where('date_due', $date->date_due)->where('user_id', auth()->user()->id)->orWhere('couple_id', $couple_id->id)->where('name', $request->name)->where('date_due', $date->date_due)->get();
            } else {
                $newBills = Bills::where('name', $request->name)->where('date_due', $date->date_due)->where('user_id', auth()->user()->id)->get();
            }

            if (!empty($newBills)) {

                $bills['date'] = $date->date_due;
                $bills['bills'] = $newBills;
                $bills['name'] = $request->name;


                array_push($newArr, $bills);
            }
        }

        $latest = $this->current_bill($request);

        return view('bills.index')->with('name', $request->name)->with('bills', $newArr)->with('latest', $latest);
    }

    // Get add bills form
    public function create()
    {
        return view('bills.create');
    }

    // Get add invoice
    public function add_invoice(Request $request)
    {

        $latest = $this->current_bill($request);

        return view('bills.invoice')->with('name', $request->name)->with('bill', $latest);
    }

    // Create a new invoice for a particular bill
    public function create_invoice(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $this->validate($request, [
            'amount_due' => 'required',
            'date_due' => 'required',
            'amount_paid' => 'required',
            'bill_type' => 'required'
        ]);

        // Check whether bill is joint or individual
        if ($request->bill_type === 'joint') {

            // Add couple id
            $couple_id = DB::table('couple')->select('id')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();
            // dd($couple_id->id);

            if ($couple_id === null) {
                return back()->with('status', 'Invite your spouse first before creating a joint Bill');
            }

            // get latest amount paid and add it to the latest amount paid
            $couple_bill = Bills::where('couple_id', $couple_id->id)->where('name', $request->name)->latest()->first();

            if ($couple_bill !== null && $couple_bill->amount_due !== $couple_bill->amount_paid) {
                $newAmountPaid = $couple_bill->amount_paid + $request->amount_paid;
            } else {
                $newAmountPaid = $request->amount_paid;
            }

            // Check if paid is greater than the amount_due
            if ($newAmountPaid > $request->amount_due) {
                return back()->with('status', 'You cant pay over the amount due!');
            }

            // Add bill with couple
            Bills::create([
                'couple_id' => $couple_id->id,
                'name' => $request->name,
                'amount_due' => $request->amount_due,
                'date_due' => $request->date_due,
                'amount_paid' => $newAmountPaid
            ]);

            // Log activity
            DB::table('activity')->insert([
                'couple_id' => $couple_id->id,
                'text' => auth()->user()->username . ' created an invoice for bill ' . $request->name,
                'created_at' => $date,
            ]);

            return back()->with('status', 'Succefully created a joint bill invoice for ' . $request->name);
        } else {

            // get latest amount paid and add it to the latest amount paid
            $bill = Bills::where('user_id', auth()->user()->id)->where('name', $request->name)->latest()->first();

            if ($bill !== null && $bill->amount_due !== $bill->amount_paid) {
                $newAmountPaid = $bill->amount_paid + $request->amount_paid;
            } else {
                $newAmountPaid = $request->amount_paid;
            }


            // Check if paid is greater than the amount_due
            if ($newAmountPaid > $request->amount_due) {
                return back()->with('status', 'You cant pay over the amount due!');
            }

            Bills::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'amount_due' => $request->amount_due,
                'date_due' => $request->date_due,
                'amount_paid' => $newAmountPaid
            ]);

            // Log activity
            DB::table('activity')->insert([
                'user_id' => auth()->user()->id,
                'text' => auth()->user()->username . ' created an invoice for bill ' . $request->name,
                'created_at' => $date,

            ]);

            return back()->with('status', 'Succefully created an individual bill invoice ' . $request->name);
        }
    }

    // Edit invoice
    public function edit(Request $request)
    {
        return view('bills.edit')->with('id', $request->id)->with('paid', $request->amount_paid)->with('name', $request->name);
    }

    // Store edit
    public function post_edit(Request $request)
    {
        $this->validate($request, [
            'paid' => 'required'
        ]);

        // Get amount due
        $amount = Bills::where('id', $request->id)->first();

        if ($request->paid > $amount->amount_due) {
            return back()->with('status', 'Amount to be paid cant exceed the amount due');
        }

        // Edit invoice

        Bills::where('id', $request->id)->where('name', $request->name)->update([
            'amount_paid' => $request->paid
        ]);

        return back()->with('status', 'Successfully updated this invoice');
    }
}
