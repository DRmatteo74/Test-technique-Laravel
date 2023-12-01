<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function show(){
        $friends = FriendController::list();
        $messages = Message::where('recipient_id', Auth::id())
                    ->where("private", false)
                    ->orderBy('created_at', 'desc')->get();


        return view('dashboard', [
            'messages' => $messages,
            'friends' => $friends["uniqueFriendUsers"],
            'askFriends' => $friends["usersWithPendingRequests"]
        ]);
    }

    public function showFriend(User $user){
        $friends = FriendController::list();
        $messages = Message::where('recipient_id', $user->id)
                    ->where("private", false)
                    ->orderBy('created_at', 'desc')->get();

        $isFriend = $friends["uniqueFriendUsers"]->contains('id', $user->id);

        if(!$isFriend){
            return redirect(route('dashboard'));
        }

        return view('dashboard', [
            'friend' => $user,
            'messages' => $messages,
            'friends' => $friends["uniqueFriendUsers"],
            'askFriends' => $friends["usersWithPendingRequests"]
        ]);
    }
}
