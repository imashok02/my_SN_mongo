<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Interest_Category;

class InterestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interest = new Interest_Category;

        $interest_category = $interest->all();
        
       return $interest_category;
        
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

        $interest_category = new Interest_Category();

        $values = [

            'name' => $request->name,
            'created_at' => date("h:i:sa")
        ];

        $result = $interest_category->insertId($values);

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
        $interest_category = new Interest_Category;

        $ok = $interest_category->findOneId($id);

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

        $interest_category = new Interest_Category();

        $values = [

             'name' => $request->name,
            'created_at' => date("h:i:sa")
        ];

        $result = $interest_category->updateOneId($id,$values);

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
        $interest_category = new Interest_Category;
        $ok = $interest_category->deleteOneId($id);
        return "Deleted Interest Category";
        
    }

}
