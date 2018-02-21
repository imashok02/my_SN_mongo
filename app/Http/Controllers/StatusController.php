<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Status;
use App\User;
use Storage;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Statusing = new Status;

        $Status = $Statusing->all();
        
       return $Status;
        
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' =>'required',
            
        ]);

        $user = new User;
        $Status = new Status();
         

        $values = [

            'status' => $request->status,
            'user_id' => $user->auth_user()->_id,
            'created_at' => date("h:i:sa")
            
        ];

        $result = $Status->insertId($values);

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Status = new Status;
        $ok = $Status->findOneId($id);
        return $ok;
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
            'status' =>'required',
            
        ]);
        
        $user = new User;

        $status = new Status();

        
        $values = [
            
            'status' => $request->status,
            'user_id' => $user->auth_user()->_id,
            'created_at' => date("h:i:sa")
        ];

        $result = $status->updateOneId($id,$values);

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
        $Status = new Status;
        $ok = $Status->deleteOneId($id);
        return($ok);
        
    }

    public function my_status()
    {
        $statusInstance = new Status;

        $userInstance = new User;

        $user_id = $userInstance->auth_user()->_id;

        $status = $statusInstance->findforUser($user_id);

        foreach ($status as $stat) {
            print_r($stat);
        }
    }

}
