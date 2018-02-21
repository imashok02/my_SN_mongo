<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Profile;

class AuthenticationController extends Controller
{

  public function signup(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);


        $user = new User();

        $email_check = $user->findforEmail($request->email);

        if($email_check === NULL)
        {
            $profile = new Profile();

        $values = [

            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'created_at' => date("h:i:sa")
        ];

        $result = $user->insertId($values);

        $values2 = [
            '_id' => $result
        ];

        $save = $profile->insertId($values2);

        return $save;

        }

        return "Sorry,Email already taken";

        
    }


    public function login(Request $request) 

    {
      $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $email = $request->email;
        $password = $request->password;
        $log = $user->authenticating($email, $password);
        return $log;
    }


    public function logout(Request $request) 
    {

      $user = new User();

      $out = $user->logout($request->api_key);
       return $out;
  	}

  	// public function test(Request $request) 
   //  {

   //    $user = new User();

   //    $out = $user->auth_user();
   //    return $out;
  	//  }


}
