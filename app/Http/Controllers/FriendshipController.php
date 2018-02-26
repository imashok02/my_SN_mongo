<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use MongoDB;
use App\Profile;
use App\Friendship;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add_friend($userRequestTo)
    {
        $userInstance = new User;
        $friendInstance = new Friendship;

        $add_friend = $userInstance->add_friend(new MongoDB\BSON\ObjectID($userRequestTo));

        return $add_friend;
    }

    public function accept_friend($userRequestFrom)
    {
        $userInstance = new User;
        $friendInstance = new Friendship;

        $accept_friend = $userInstance->accept_friend(new MongoDB\BSON\ObjectID($userRequestFrom));

        return $accept_friend;
    }


    public function friends()
    {
        $userInstance = new User;
        $friendInstance = new Friendship;

        $friends = $userInstance->friends();

        return $friends;
    }

    public function pending_requests()
    {
        $userInstance = new User;
        $friendInstance = new Friendship;

        $pending = $userInstance->pending_friend_requests();

        return $pending;
    }

}
