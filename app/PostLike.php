<?php

namespace App;

use MongoDB;
use App\ParentModel;


// require_once 'DBConnection.php';
// require_once 'session.php';


class PostLike extends ParentModel {

    protected $collection = "post_likes";


    public function validate_like($postId, $userId)
    {
    	$find = $this->collection->find(array('$and' => array(array('post_id' => $postId), array('user_id' => $userId))));

    	return iterator_to_array($find);
    }


    public function deleteOneDoc($value)
    {
    	$find = $this->collection->deleteOne(array('_id' => $value));

    	return "deleted";
    }


}