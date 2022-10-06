<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    // Accounts view
    public function index(Request $request)
    {
        // Fetch accounts with user_id and account name

        // Get couple id
        $couple_id = DB::table('couple')->select('id')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        // Get accounts

        $accounts = array();
        if ($couple_id !== null) {
            $accounts_couples = DB::table('accounts')->where('type', $request->name)->where('couple_id', $couple_id->id)->get();

            $accounts_users = DB::table('accounts')->where('type', $request->name)->where('user_id', auth()->user()->id)->get();

            // Push to new array
            if (count($accounts_couples) > 0) {
                array_push($accounts, $accounts_couples);
            }

            if (count($accounts_users) > 0) {
                array_push($accounts, $accounts_users);
            }

            return view('accounts.index')->with('name', $request->name)->with('accounts', $accounts);
        } else {
            $accounts_users = DB::table('accounts')->where('type', $request->name)->where('user_id', auth()->user()->id)->get();

            array_push($accounts, $accounts_users);

            return view('accounts.index')->with('name', $request->name)->with('accounts', $accounts);
        }


        // dd($accounts);
    }

    // Add accounts
    public function add(Request $request)
    {
        return view('accounts.add')->with('name', $request->name);
    }

    // Create account
    public function create_account(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'account_deposit' => 'required',

            'details' => 'required'
        ]);




        // Create an account

        if ($request->name === 'Joint savings' || $request->name === 'Joint expenditures') {

            // Get couples id
            $couple_id = DB::table('couple')->select('id')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

            if ($couple_id === null) {
                return back()->with('status', 'Get a spouse inorder to store your joint account');
            }
            // Add couples id in table

            if (isset($request->account_saving)) {

                DB::table('accounts')->insert([
                    'couple_id' => $couple_id->id,
                    'type' => $request->name,
                    'name' => $request->account_name,
                    'deposit' => $request->account_deposit,
                    'target' => $request->account_saving,
                    'about' => $request->details
                ]);
            } else {
                DB::table('accounts')->insert([
                    'couple_id' => $couple_id->id,
                    'type' => $request->name,
                    'name' => $request->account_name,
                    'deposit' => $request->account_deposit,
                    'about' => $request->details
                ]);
            }

            return back()->with('status', 'Successfully added an account under "' . $request->name . '"');
        } else {
            // Add users id

            if (isset($request->account_saving)) {

                DB::table('accounts')->insert([
                    'user_id' => auth()->user()->id,
                    'type' => $request->name,
                    'name' => $request->account_name,
                    'deposit' => $request->account_deposit,
                    'target' => $request->account_saving,

                    'about' => $request->details
                ]);
            } else {
                DB::table('accounts')->insert([
                    'user_id' => auth()->user()->id,
                    'type' => $request->name,
                    'name' => $request->account_name,
                    'deposit' => $request->account_deposit,

                    'about' => $request->details
                ]);
            }
            return back()->with('status', 'Successfully added an account under "' . $request->name . '"');
        }
    }

    // Delete account

    public function delete_account(Request $request)
    {
        DB::table('accounts')->where('id', $request->id)->delete();

        return back()->with('status', 'Account has been deleted');
    }

    // Add saving
    public function add_savings(Request $request)
    {
        // get account

        $account = DB::table('accounts')->where('id', $request->id)->first();

        return view('accounts.add_saving')->with('account', $account);
    }

    // New saving
    public function new_saving(Request $request)
    {
        $this->validate($request, [
            'account_deposit' => 'required'
        ]);

        // update account
        $account = DB::table('accounts')->where('id', $request->id)->first();

        $newDeposit = $request->account_deposit + $account->deposit;
        if ($newDeposit > $account->target) {
            return back()->with('status', 'Deposit cant be more than target');
        }


        DB::table('accounts')->where('id', $request->id)->update([
            'deposit' => $newDeposit
        ]);

        // Record activity

        $date = date('Y-m-d H:i:s');

        if ($account->couple_id !== null) {

            $message = auth()->user()->username . " edited " . $account->name . " account in joint savings category";

            DB::table('activity')->insert([
                'couple_id' => $account->couple_id,
                'text' => $message,
                'created_at' => $date
            ]);
        } else {
            $message = auth()->user()->username . " edited " . $account->name . " account in my savings category";

            DB::table('activity')->insert([
                'user_id' => auth()->user()->id,
                'text' => $message,
                'created_at' => $date
            ]);
        }

        return back()->with('status', 'Successfully edited account');
    }
}
