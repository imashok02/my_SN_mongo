<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Language;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languageInstance = new Language;

        $languages = $languagesInstance->all();
        
       return $languages;
        
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
            'name' =>'required|min:3'
            
        ]);

        $languages = new Language();

        $values = [

            'name' => $request->name,
            'created_at' => date("h:i:sa")
        ];

        $result = $languages->insertId($values);

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
        $languages = new Language;

        $ok = $languages->findOneId($id);

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
            'name' =>'required|min:3'
            
        ]);


        $languages = new Language();

        $values = [

             'name' => $request->name,
            'created_at' => date("h:i:sa")
        ];

        $result = $languages->updateOneId($id,$values);

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
        $languages = new Language;
        $ok = $languages->deleteOneId($id);
        return "Deleted a Language";
        
    }

}
