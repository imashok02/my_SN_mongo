<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\PostLike;
use MongoDB;

class PostLikeController extends Controller
{
    public function like($postId)
    {
    	$user = new User;
    	$post = new Post;

    	$like = new PostLike;



    	$value = $like->validate_like($postId, $user->auth_user()->_id);
    	
        if(empty($value))
        {
            $values = [
                'post_id' => $postId,
                'user_id' => $user->auth_user()->_id
            ];

            $result = $like->insertId($values);

            return $result;
        } 
        else {
            return "already Liked this one";
        }   
    
    	
    }


    public function unlike($postId)
    {
        $user = new User;
        $post = new Post;

        $like = new PostLike;

        $value = $like->validate_like($postId, $user->auth_user()->_id);
        
        
        //finding if alredy liked if yes

       if(count($value) == 1)
       {

        //finding and passing the id in the post_likes collections to delete 
         $findPost = $like->findOnePost($postId);

         //deleting what have found

         $delete_like = $like->deleteOneDoc($findPost->_id);

         return "unliked";
       }

       else {
        return "You need to like first";
       }
    
        
    }


}
