<?php

namespace App;

use App\ParentModel;
use Hash;
use MongoDB;
use App\Traits\Friendable;
// require_once 'DBConnection.php';
// require_once 'session.php';


class User extends ParentModel {

    use Friendable;

    const COLLECTION = 'users';
    private $_mongo;
    protected $collection = "users";
    private $user;


    public function authenticating($email, $password)
	{

		$query = array(
			'email' => $email,
			'password' => $password
		);


		$user = $this->collection->findOne(array('email' => $email ));

		$user_password = Hash::check($password, $user->password);
    
		if(!$user_password)

			return response()->json(['status' => 'failed to log in','email' => $email]);
		// $_SESSION['user_id'] = (string) $this->_user['_id'];
		else

		  $apikey = base64_encode(str_random(40));
			
 
          $findingUser = $this->collection->findOne(array('_id' => new  MongoDB\BSON\ObjectID($user->_id)));

        
          $addind_apikey = $this->collection->updateOne(array('_id' => new MongoDB\BSON\ObjectID($findingUser->_id)), array('$set' => array('api_key' => $apikey)));

 
          return response()->json(['status' => 'success','api_key' => $apikey]);
	}



	public function logout($key) 
    {

      $api_key = $key;
      $user = $this->collection->findOne(array('api_key' => $key));
      if(!$user)
	      {
	        return response()->json(['status'=>'failed'], 401);
	      }

      $remove_apikey = $this->collection->updateOne(array('_id' => new MongoDB\BSON\ObjectID($user->_id)),
       array('$set' => array('api_key' => null)));

 
      return response()->json(["You have been logged out"]);
    }

    


    public function auth_user()
    {
    	$key = $_REQUEST['api_key'];
    	$authuser = $this->collection->findOne(array('api_key' => $key));

    	return $authuser;
    }

    public function findforEmail($email)
    {
        $result = $this->collection->findOne(array('email' =>($email)));

       return $result;
    }


    public function findforFriend($id)
    {
        $result = $this->collection->find(array('_id' => new MongoDB\BSON\ObjectID($id)));

       return $result;
    }

    


}