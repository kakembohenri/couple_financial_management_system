<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\InviteSpouse;
use App\Models\Bills;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class DashboardController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['auth']);
    // }


    public function index()
    {

        // couple id
        $couple = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        // get my bills
        if ($couple !== null) {
            $bills = Bills::where('user_id', auth()->user()->id)->orWhere('couple_id', $couple->id)->take(10)->get();
            $isMarried = true;
        } else {
            $bills = Bills::where('user_id', auth()->user()->id)->take(10)->get();
            $isMarried = false;
        }

        // get upcoming expenses

        $text = "%" . "invoice" . "%";
        if ($couple !== null) {
            $expense = Bills::where('couple_id', $couple->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '>', now())->orderBy('date_due', 'asc')->orWhere('user_id', auth()->user()->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '>', now())->orderBy('date_due', 'asc')->first();

            $overdue = Bills::where('couple_id', $couple->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '<', now())->orWhere('user_id', auth()->user()->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '<', now())->get();
            // $overdue = Bills::where('couple_id', $couple->id)->where('amount_due', '!=', 'amount_paid')->first();

            // dd($overdue);
            // get latest payments

            $latest_individual = DB::table('activity')->where('user_id', auth()->user()->id)->where('text', 'LIKE', $text)->latest()->first();
            $latest_couple = DB::table('activity')->where('couple_id', $couple->id)->where('text', 'LIKE', $text)->latest()->first();

            if ($latest_individual !== null && $latest_couple !== null) {
                // dd($latest_individual->created_at);
                if ($latest_individual->created_at > $latest_couple->created_at) {
                    $latest = $latest_individual;
                } else {
                    $latest = $latest_couple;
                }
            } elseif ($latest_individual === null) {
                $latest = $latest_couple;
            } else {
                $latest = $latest_individual;
            }
        } else {
            $expense = Bills::where('user_id', auth()->user()->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '>', now())->orderBy('date_due', 'asc')->first();
            $overdue = Bills::where('user_id', auth()->user()->id)->where('amount_due', '!=', 'amount_paid')->where('date_due', '<', now())->orderBy('date_due', 'desc')->get();

            $latest = DB::table('activity')->where('user_id', auth()->user()->id)->where('text', 'LIKE', $text)->latest()->first();
        }


        return view('dashboard.dashboard')->with('bills', $bills)->with('expense', $expense)->with('married', $isMarried)->with('latest', $latest)->with('overdue', $overdue);
    }

    // Invite spouse
    public function invite(Request $request)
    {

        $this->validate($request, [
            'email' => 'required'
        ]);

        // Create record in invitations table

        DB::table('invitations')->insert([
            'sender' => auth()->user()->email,
            'reciever' => $request->email,
        ]);

        Mail::to($request->email)->send(new InviteSpouse(auth()->user()->email, $request->email));

        return back()->with('status', 'Invitation has been sent successfully');
    }

    // Accept invitation
    public function accept_invitation(Request $request)
    {

        // Accept invitaion
        DB::table('invitations')->where([
            'sender' => $request->sender,
            'reciever' => $request->reciever
        ])->update([
            'status' => 'ok'
        ]);

        return redirect()->route('register')->with('success', 'Proceed with creating your account');
    }

    // Paid expenditures
    public function paid()
    {
        // get couples id
        $user = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        $couple = $user;

        // get all my bills for rent


        $total_rent_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Rent')->sum('amount_paid');

        if ($couple !== null) {

            $total_rent_couple = Bills::where('couple_id', $couple->id)->where('name', 'Rent')->sum('amount_paid');

            $rent = $total_rent_individual + $total_rent_couple;
        }

        $rent = $total_rent_individual;

        // get all my bills for electircity

        $total_Electricity_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Electricity')->sum('amount_paid');

        if ($couple !== null) {

            $total_Electricity_couple = Bills::where('couple_id', $couple->id)->where('name', 'Electricity')->sum('amount_paid');
            $Electricity = $total_Electricity_individual + $total_Electricity_couple;
        }

        $Electricity = $total_Electricity_individual;

        // get all my bills for Fuel

        $total_Fuel_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Fuel')->sum('amount_paid');

        if ($couple !== null) {

            $total_Fuel_couple = Bills::where('couple_id', $couple->id)->where('name', 'Fuel')->sum('amount_paid');
            $Fuel = $total_Fuel_individual + $total_Fuel_couple;
        }

        $Fuel = $total_Fuel_individual;

        // get all my bills for Medicical

        $total_Medical_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Medical')->sum('amount_paid');

        if ($couple !== null) {

            $total_Medical_couple = Bills::where('couple_id', $couple->id)->where('name', 'Medical')->sum('amount_paid');

            $Medical = $total_Medical_individual + $total_Medical_couple;
        }

        $Medical = $total_Medical_individual;


        // get all my bills for food

        $total_Food_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Food')->sum('amount_paid');

        if ($couple !== null) {

            $total_Food_couple = Bills::where('couple_id', $couple->id)->where('name', 'Food')->sum('amount_paid');

            $Food = $total_Food_individual + $total_Food_couple;
        }

        $Food = $total_Food_individual;

        // get all my bills for water

        $total_Water_individual = Bills::where('user_id', auth()->user()->id)->where('name', 'Water')->sum('amount_paid');

        if ($couple !== null) {

            $total_Water_couple = Bills::where('couple_id', $couple->id)->where('name', 'Water')->sum('amount_paid');

            $Water = $total_Water_individual + $total_Water_couple;
        }
        $Water = $total_Water_individual;


        $total = $rent + $Electricity + $Fuel + $Medical + $Food + $Water;

        return view('expenditures.paid')->with('rent', $rent)->with('elec', $Electricity)->with('fuel', $Fuel)->with('medic', $Medical)->with('food', $Food)->with('water', $Water)->with('total', $total);
    }

    // unpaid expenditures

    public function unpaid()
    {
        // get couples id
        $user = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        $couple = $user;

        //  get balances rent
        $rent_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Rent')->latest()->first();

        if ($rent_i === null) {
            $bal_i = 0;
        } else {

            $bal_i = $rent_i->amount_due - $rent_i->amount_paid;
        }

        if ($couple !== null) {

            $rent_c = Bills::where('couple_id', $couple->id)->where('name', 'Rent')->latest()->first();
        } else {
            $rent_c = null;
        }

        if ($rent_c === null) {
            $bal_r = 0;
        } else {

            $bal_r = $rent_c->amount_due - $rent_c->amount_paid;
        }

        $rent = $bal_i + $bal_r;

        // get balances electricity

        $elc_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Electricity')->latest()->first();

        if ($elc_i === null) {
            $elc_i = 0;
        } else {

            $elc_i = $elc_i->amount_due - $elc_i->amount_paid;
        }

        if ($couple !== null) {

            $elec_c = Bills::where('couple_id', $couple->id)->where('name', 'Electricity')->latest()->first();
        } else {
            $elec_c = null;
        }

        if ($elec_c === null) {
            $elec_c = 0;
        } else {

            $elec_c = $elec_c->amount_due - $elec_c->amount_paid;
        }

        $elec = $elc_i + $elec_c;

        // get balances fuel

        $f_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Fuel')->latest()->first();

        if ($f_i === null) {
            $f_i = 0;
        } else {

            $f_i = $f_i->amount_due - $f_i->amount_paid;
        }

        if ($couple !== null) {

            $f_c = Bills::where('couple_id', $couple->id)->where('name', 'Fuel')->latest()->first();
        } else {
            $f_c = null;
        }

        if ($f_c === null) {
            $f_c = 0;
        } else {

            $f_c = $f_c->amount_due - $f_c->amount_paid;
        }

        $fuel = $f_i + $f_c;

        // get medical

        $m_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Medical')->latest()->first();

        if ($m_i === null) {
            $m_i = 0;
        } else {

            $m_i = $m_i->amount_due - $m_i->amount_paid;
        }

        if ($couple !== null) {

            $m_c = Bills::where('couple_id', $couple->id)->where('name', 'Medical')->latest()->first();
        } else {
            $m_c = null;
        }


        if ($m_c === null) {
            $m_c = 0;
        } else {

            $m_c = $m_c->amount_due - $m_c->amount_paid;
        }

        $med = $m_i + $m_c;

        // get food

        $foo_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Food')->latest()->first();

        if ($foo_i === null) {
            $foo_i = 0;
        } else {

            $foo_i = $foo_i->amount_due - $foo_i->amount_paid;
        }

        if ($couple !== null) {

            $foo_c = Bills::where('couple_id', $couple->id)->where('name', 'Food')->latest()->first();
        } else {
            $foo_c = null;
        }

        if ($foo_c === null) {
            $foo_c = 0;
        } else {

            $foo_c = $foo_c->amount_due - $foo_c->amount_paid;
        }

        $food = $foo_i + $foo_c;

        // get water

        $w_i = Bills::where('user_id', auth()->user()->id)->where('name', 'Water')->latest()->first();

        if ($w_i === null) {
            $w_i = 0;
        } else {
            $w_i = $w_i->amount_due - $w_i->amount_paid;
        }

        if ($couple !== null) {

            $w_c = Bills::where('couple_id', $couple->id)->where('name', 'Water')->latest()->first();
        } else {
            $w_c = null;
        }

        if ($w_c === null) {
            $w_c = 0;
        } else {

            $w_c = $w_c->amount_due - $w_c->amount_paid;
        }

        $water = $w_i + $w_c;

        $total = $rent + $elec + $fuel + $med + $food + $water;
        return view('expenditures.unpaid')->with('rent', $rent)->with('elec', $elec)->with('fuel', $fuel)->with('medic', $med)->with('food', $food)->with('water', $water)->with('total', $total);
    }
    // fecbfe
    // Get report

    public function report()
    {

        // get couples id
        $couple = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        // Get all user bills

        if ($couple === null) {

            $bills = Bills::where('user_id', auth()->user()->id)->get();
        } else {
            $bills = Bills::where('user_id', auth()->user()->id)->orWhere('couple_id', $couple->id)->get();
        }

        return view('expenditures.report')->with('bills', $bills);
    }

    // Activity
    public function activity()
    {
        // get activity
        $couple_id = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();


        if ($couple_id !== null) {
            // get activities
            $activities = DB::table('activity')->where('couple_id', $couple_id->id)->orWhere('user_id', auth()->user()->id)->get();
        } else {
            $activities = DB::table('activity')->where('user_id', auth()->user()->id)->get();
        }


        return view('expenses.activity')->with('activities', $activities);
    }

    // Upcoming
    public function upcoming()
    {

        $couple = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        // get my bills
        if ($couple !== null) {
            $bills = Bills::where('user_id', auth()->user()->id)->orWhere('couple_id', $couple->id)->take(10)->get();
            $isMarried = true;
        } else {
            $bills = Bills::where('user_id', auth()->user()->id)->take(10)->get();
            $isMarried = false;
        }

        // get upcoming expenses

        if ($couple !== null) {
            $expenses = Bills::where('user_id', auth()->user()->id)->where('date_due', '>', now())->orderBy('date_due', 'asc')->orWhere('couple_id', $couple->id)->where('date_due', '>', now())->orderBy('date_due', 'asc')->get();
        } else {
            $expenses = Bills::where('user_id', auth()->user()->id)->where('date_due', '>', now())->orderBy('date_due', 'asc')->get();
        }

        return view('expenses.upcoming')->with('bills', $expenses);
    }

    // Print pdf
    public function print()
    {
        // get couples id
        $couple = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        // Get all user bills

        if ($couple === null) {

            $bills = Bills::where('user_id', auth()->user()->id)->get();
        } else {
            $bills = Bills::where('user_id', auth()->user()->id)->orWhere('couple_id', $couple->id)->get();
        }

        return view('pdf')->with('bills', $bills);
    }
}
