<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request, User $user){
        $message = $request->message;

        Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $user->id,
            'message' => $message,
            'private' => false
        ]);

        if($user->id != Auth::id()){
            return redirect()->route('dashboard.friend', $user);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function sendPrivate(Request $request, User $user){
        Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $user->id,
            'message' => $request->message,
            'private' => true
        ]);

        return redirect()->route('dashboard');
    }
}
