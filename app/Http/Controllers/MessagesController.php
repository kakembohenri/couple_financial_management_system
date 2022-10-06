<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index()
    {
        // get messages
        $messages = Messages::where('sender_id', auth()->user()->id)->orWhere('reciever_id', auth()->user()->id)->get();

        // get spouse
        $spouse = DB::table('couple')->where('wife', auth()->user()->id)->orWhere('husband', auth()->user()->id)->first();

        if ($spouse === null) {
            return redirect()->route('dashboard')->with('status', 'Invite your spouse first before accessing the chat feature');
        } else {
            if (auth()->user()->id !== $spouse->wife) {
                $user = User::select('username')->where('id', $spouse->wife)->first();
            } elseif (auth()->user()->id !== $spouse->husband) {
                $user = User::select('username')->where('id', $spouse->husband)->first();
            }

            return view('inbox.chat')->with('messages', $messages)->with('username', $user->username);
        }
    }

    // Send message
    public function send(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Get spouse id
        if (auth()->user()->gender === 'male') {
            $spouse = DB::table('couple')->select('wife')->where('husband', auth()->user()->id)->get();
            $id = $spouse[0]->wife;
        } elseif (auth()->user()->gender === 'female') {
            $spouse = DB::table('couple')->select('husband')->where('wife', auth()->user()->id)->get();
            $id = $spouse[0]->husband;
        }

        Messages::create([
            'sender_id' => auth()->user()->id,
            'reciever_id' => $id,
            'body' => $request->body
        ]);

        return back()->with('status', 'Message sent');
    }
}
