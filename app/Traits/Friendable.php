<?php
namespace App\Traits;
use App\Friendship;
use App\User;
use MongoDB;

trait Friendable
{

	public function add_friend($userRequestTo)
	{
		$user = new User;

		$userId = $user->auth_user()->_id;

		if($userId == $userRequestTo)
		{
			return 0;
		}
		else 
		{
			$friendship =  new Friendship;

		$values = [

			'requestor' => $userId,
			'userRequestedTo' => $userRequestTo,
			'status' => 0

		];

		$add_friend = $friendship->insertId($values);

	
		if($add_friend)
		{
			return 1;
		}
		return 0;
		}

		
	}


	public function accept_friend($userRequested)
	{
		
		$friend_instance = new Friendship;
		$user_instance = new User;


		$friendship = $friend_instance->findOneRequestor(new MongoDB\BSON\ObjectID($userRequested));

		
		if($friendship)
		{
			$values = [
				'status' => 1
			];

			$accept_friend = $friend_instance->updateOneId($friendship->_id,$values);

			return 1;
		}
		return 0;
	}


	public function friends()
	{
		$friends1 = array();

			$friend_instance = new Friendship;
			$user_instance = new User;

			$f1 = $friend_instance->findRequestorWithstatus1($user_instance->auth_user()->_id);


			foreach ($f1 as $friendship) {
				// $findUser = $friend_instance->findOneId($friendship);
				

				array_push($friends1, $friendship->requestor);
			}
					


		$friends2 = array();

		$friend_instance = new Friendship;
			$user_instance = new User;

			$f2 = $friend_instance->findUserRequestFromWithstatus1($user_instance->auth_user()->_id);


			foreach ($f2 as $friendship) {

				array_push($friends1,$friendship->userRequestedTo);
			}
	
		
		return array_merge($friends1, $friends2);
	}


	public function pending_friend_requests()
	{
		$friend_instance = new Friendship;
		$user_instance = new User;
		$users = array();

		$f1 = $friend_instance->findRequestorWithstatus0($user_instance->auth_user()->_id);
		dd($f1);
		foreach($f1 as $friendship):
			array_push($users, $f1->requestor);
		endforeach;
		return $users;
	}


	// public function friends_ids()
	// {
	// 	return collect($this->friends())->pluck('id')->toArray();
	// }


	// public function is_friends_with($user_id)
	// {
	// 	if(in_array($user_id, $this->friends_ids()))
	// 	{
	// 		return 1;
	// 	}
	// 	else
	// 	{
	// 		return 0;
			
	// 	}
	// }


	// public function pending_friend_request_ids()
	// {
	// 	return collect($this->pending_friend_requests())->pluck('id')->toArray();
	// }


	// public function pending_friend_requests_sent()
	// {
	// 	$users = array();
	// 	$friendships = Friendship::where('status', 0)->where('requestor',$this->id)->get();
	// 	foreach($friendships as $friendship):
	// 		array_push($users, \App\User::find($friendship->user_requested));
	// 	endforeach;
	// 	return $users;
	// }


	// public function pending_friend_request_sent_ids()
	// {
	// 	return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
	// }


	// public function has_pending_friend_requests_from($user_id)
	// {
	// 	if(in_array($user_id, $this->pending_friend_request_ids()))
	// 	{
	// 		return 1;
	// 	}
	// 	else
	// 	{
	// 		return 0;
	// 	}
	// }


	// public function has_pending_friend_requests_to($user_id)
	// {
	// 	if(in_array($user_id, $this->pending_friend_request_sent_ids()))
	// 	{
	// 		return 1;
	// 	}
	// 	else
	// 	{
	// 		return 0;
	// 	}
	// }


}