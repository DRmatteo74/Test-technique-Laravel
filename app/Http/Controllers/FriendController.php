<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public static function list()
    {
        $userId = Auth::id();
        $friends = Friend::where('user1_id', $userId)
                    ->orWhere('user2_id', $userId)
                    ->get();

        $friendUsers = collect([]);
        $usersWithPendingRequests = collect([]);

        foreach ($friends as $friend) {
            if($friend->accepted == true){
                if ($friend->user1->id != $userId) {
                    $friendUsers->push($friend->user1);
                }

                if ($friend->user2->id != $userId) {
                    $friendUsers->push($friend->user2);
                }
            }else{
                if ($friend->user1->id != $userId) {
                    $usersWithPendingRequests->push($friend->user1);
                }
            }

        }

        $uniqueFriendUsers = $friendUsers->unique('id')->values();
        $usersWithPendingRequests = $usersWithPendingRequests->unique('id')->values();

        return compact("uniqueFriendUsers", "usersWithPendingRequests");
    }

    public function getUsers($search = ""){
        $authenticatedUserId = Auth::id();

        $users = User::where('id', '<>', $authenticatedUserId)
            ->whereNotIn('id', function($query) use ($authenticatedUserId) {
                $query->select('user2_id')
                    ->from('friends')
                    ->where('user1_id', $authenticatedUserId)
                    ->where('accepted', true);
            })
            ->whereNotIn('id', function($query) use ($authenticatedUserId) {
                $query->select('user1_id')
                    ->from('friends')
                    ->where('user2_id', $authenticatedUserId)
                    ->where('accepted', true);
            })
            ->where('name', 'like', "%$search%")
            ->orderBy('name')->get();

        $usersWithPendingRequests = Friend::where('user1_id', $authenticatedUserId)
            ->where('accepted', false)
            ->pluck('user2_id')
            ->toArray();

        return view("users", compact("users", "usersWithPendingRequests", "search"));
    }

    public function getUserData(User $user){
        return view("users", compact("user"));
    }

    public function searchUsers(Request $request){
        $search = $request->search;

        return $this->getUsers($search);
    }

    public function createFriends(User $user){
        Friend::create([
            'user1_id' => Auth::id(),
            'user2_id' => $user->id,
            'accepted' => false
        ]);

        return redirect()->route('users');
    }

    public function acceptFriend(User $user){
        $userId = Auth::id();

        Friend::where(function ($query) use ($userId, $user) {
            $query->where('user1_id', $user->id)
                ->where('user2_id', $userId);
        })->update(['accepted' => true]);

        return redirect()->route('dashboard');
    }

    public function denyFriend(User $user){
        $userId = Auth::id();

        Friend::where(function ($query) use ($userId, $user) {
            $query->where('user1_id', $user->id)
                ->where('user2_id', $userId);
        })->delete();

        return redirect()->route('dashboard');
    }
}
