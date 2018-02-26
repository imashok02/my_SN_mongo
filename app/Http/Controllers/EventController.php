<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Event;
use App\User;
use App\Location;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $eventing = new Event;

        $event = $eventing->all();
        
       return $event;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locate = new Location;

        return $locate->all();

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
            'name' =>'required|min:3',
            'description' => 'required|min:10',
            'date' => 'required',
            'file' => 'required|mimes:jpeg,jpg,bmp,png,video/x-flv,video/mp4,video/3gpp',
            'location' => 'required'
            
        ]);

       $user = new User;
        $event = new Event();

        $upload_url1 = 'http://s3.amazonaws.com/';

         $upload_folder = '/data/media/';

         $image = $request->file('file');

         $imageFileName = time() . '.' . $image->getClientOriginalExtension();

         $s3 = \Storage::disk('s3');

         $filePath = '/data/media/' . $imageFileName;

         $va = $s3->put($filePath, file_get_contents($image), 'public');

         $media = $upload_url1.config('filesystems.disks.s3.bucket').$upload_folder.$imageFileName;

        $values = [

            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => $user->auth_user()->_id,
            'location' => $request->location,
            'media' => $media,
            'created_at' => date("h:i:sa")
        ];

        $result = $event->insertId($values);



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
        $event = new Event;

        $ok = $event->findOneId($id);

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
            'name' =>'required|min:3',
            'description' => 'required|min:10',
            'date' => 'required',
            'file' => 'required|mimes:jpeg,jpg,bmp,png,video/x-flv,video/mp4,video/3gpp',
            'location' => 'required'
            
        ]);


        $user = new User;
        $event = new Event();

        $upload_url1 = 'http://s3.amazonaws.com/';

         $upload_folder = '/data/media/';

         $image = $request->file('file');

         $imageFileName = time() . '.' . $image->getClientOriginalExtension();

         $s3 = \Storage::disk('s3');

         $filePath = '/data/media/' . $imageFileName;

         $va = $s3->put($filePath, file_get_contents($image), 'public');

         $media = $upload_url1.config('filesystems.disks.s3.bucket').$upload_folder.$imageFileName;

         $values = [

             'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => $user->auth_user()->_id,
            'location' => $request->location,
            'media' => $media,
            'created_at' => date("h:i:sa")
        ];

        $result = $event->updateOneId($id,$values);

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
        $event = new Event;
        $ok = $event->deleteOneId($id);
        return "Deleted Event";
        
    }

    public function my_events()
    {
        $eventInstance = new Event;

        $userInstance = new User;

        $user_id = $userInstance->auth_user()->_id;

        $events = $eventInstance->findforUser($user_id);

        foreach ($events as $event) {
            print_r($event);
        }
    }


}
