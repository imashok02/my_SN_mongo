<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Interest;
use App\Interest_Category;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interest = new Interest;

        $interest = $interest->all();
        
       return $interest;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $interest_category = new Interest_Category;

        return $interest_category->all();

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
            'interest_category' => 'required'
            
        ]);

       
        $interest = new Interest();

        $values = [

            'name' => $request->name,
            'interest_category_id' => $request->interest_category_id,
            'created_at' => date("h:i:sa")
        ];

        $result = $interest->insertId($values);



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
        $interest = new Interest;

        $ok = $interest->findOneId($id);

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
            'interest_category' => 'required'
            
        ]);


        $interest = new Interest();

        $values = [

             'name' => $request->name,
             'interest_category_id' => $request->interest_category_id,
            'created_at' => date("h:i:sa")
        ];

        $result = $interest->updateOneId($id,$values);

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
        $interest = new Interest;
        $ok = $interest->deleteOneId($id);
        return "Deleted An Interest";
        
    }

}
