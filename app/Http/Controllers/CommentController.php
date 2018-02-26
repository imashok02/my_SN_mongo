<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Post;
use App\User;
use App\Comment;
use MongoDB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post)
    {

        
        $comment = new Comment;

        $valid_post = $comment->is_valid_post(new  MongoDB\BSON\ObjectID($post));

        if(empty($valid_post))
        {
            return "Not a valid Post";
            die();
        }

        $find_comment_post = $comment->findPost(new  MongoDB\BSON\ObjectID($post));

        return $find_comment_post;
        
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
    public function store(Request $request, $post)
    {
        $this->validate($request, [
            'comment' =>'required'
            
        ]);

        $user = new User;
        $comment = new Comment;

        $values = [

            'comment' => $request->comment,
            'post_id' => new  MongoDB\BSON\ObjectID($post),
            'user_id' => $user->auth_user()->_id,
            'created_at' => date("h:i:sa")
        ];

        $result = $comment->insertId($values);

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post,$id)
    {



        $comment = new Comment;

         $valid_post = $comment->is_valid_post($post);

        if(empty($valid_post))
        {
            return "Not a valid Post";
            die();
        }

        $ok = $comment->findOneId($id);
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
    public function update(Request $request, $post, $id )
    {
        $this->validate($request, [
            'comment' =>'required'
            
        ]);


        $user = new User;
        $comment = new Comment();


        $valid_post = $comment->is_valid_post(new MongoDB\BSON\ObjectID($post));

        if(empty($valid_post))
        {
            return "Not a valid Post";
            die();
        }

    
        $find_post = $comment->findOnePost(new MongoDB\BSON\ObjectID($post));

        $values = [
            
            'comment' => $request->comment,
            'user_id' => $user->auth_user()->_id,
            'post_id' => new  MongoDB\BSON\ObjectID($find_post),
            'created_at' => date("h:i:sa")
        ];

        $result = $comment->updateOneId($id,$values);

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
        $comment = new Comment;
        $ok = $comment->deleteOneId($id);
        return "Deleted Comment";
        
    }

}
