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

        return redirect()->route('private.message.friend', $user);
    }

    public function showPrivate(){
        $friends = FriendController::list();
        return view('private-message', [
            'friends' => $friends["uniqueFriendUsers"],
            'askFriends' => $friends["usersWithPendingRequests"]
        ]);
    }

    public function showPrivateFriend(User $user){
        $friends = FriendController::list();

        $authenticatedUserId = Auth::id();

        $messages = Message::where(function ($query) use ($authenticatedUserId, $user) {
            $query->where('sender_id', $authenticatedUserId)
                ->where('recipient_id', $user->id)
                ->where("private", true);
        })->orWhere(function ($query) use ($authenticatedUserId, $user) {
            $query->where('sender_id', $user->id)
                ->where('recipient_id', $authenticatedUserId)
                ->where("private", true);
        })->orderBy('created_at', 'desc')->get();

        $isFriend = $friends["uniqueFriendUsers"]->contains('id', $user->id);

        if(!$isFriend){
            return redirect(route('private.message'));
        }

        return view('private-message', [
            'friend' => $user,
            'messages' => $messages,
            'friends' => $friends["uniqueFriendUsers"],
            'askFriends' => $friends["usersWithPendingRequests"]
        ]);
    }
}
