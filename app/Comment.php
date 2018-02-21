<?php

namespace App;

use MongoDB;
use App\ParentModel;


// require_once 'DBConnection.php';
// require_once 'session.php';


class Comment extends ParentModel {

    protected $collection = "comments";


   
    public function find_post()
    {
    	dd($post);
    	$post_id = $_REQUEST['post'];

    	$find_post = $this->collection->findOne(array('post_id' => $post_id));

    	return $find_post;
    }



}