<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Profile;
use MongoDB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInstance = new User;

        $user = $userInstance->auth_user();
        
       return $user;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
            
    //     ]);


    //    $userInstance = new User();

    //     $profileInstance = new Profile();

    //     $values = [

    //         'mobile' => $request->mobile,
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'gender' => $request->gender,
    //         'location '=> $request->location,
    //         'languages' => $request->languages,
    //         'post_id' => $request->post_id,
    //         'fb_page' => $request->fb_page,
    //         'twitter_page' => $request->twitter_page,
    //         'insta_page' => $request->insta_page,
    //         'youtube_page' => $request->youtube_page

    //     ];

    //     $profile_save = $profileInstance->insertId($values);

        



    //     $values2 = [

    //         'name' => 'Ashok',
    //         'profile_id' => $profile_save


    //     ];

    //     $user = $userInstance->insertId($values2);

        

    //     return $user;
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $userInstance = new User;

        $profileInstance = new Profile;

        
        $profile = $profileInstance->findOneId(new  MongoDB\BSON\ObjectID($id));
        

         $user = $userInstance->findOneId($profile->user_id);

        return response()->json([$user, $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'first_name' =>'required|min:3',
            'last_name' => 'required|min:3'
            
        ]);

        $userInstance = new User();

        $profileInstance = new Profile();

        $values = [

            'mobile' => $request->mobile,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            // 'email' => $request->email,
            'gender' => $request->gender,
            //pro_tag_line => $request->pro_tag_line,
            'location '=> $request->location,
            'languages' => $request->languages,
            'post_id' => $request->post_id,
            'fb_page' => $request->fb_page,
            'twitter_page' => $request->twitter_page,
            'insta_page' => $request->insta_page,
            'youtube_page' => $request->youtube_page,
            'created_at' => date("h:i:sa")

        ];

        $result = $profileInstance->updateOneId($id,$values);

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userInstance = new Profile;
        $ok = $userInstance->deleteOneId($id);
        return "Profile Deleted";
        
    }


    public function attach(Request $request, $id)
    {
        $userInstance = new Profile;

        $values = [

            'comment' => $request->comment

        ];

        $ok = $userInstance->embedd($id,$values);
    }
    

}
