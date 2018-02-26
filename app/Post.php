<?php

namespace App;


use App\ParentModel;
use MongoDB;


// require_once 'DBConnection.php';
// require_once 'session.php';


class Post extends ParentModel {

    protected $collection = "posts";

    public function valid_post($value)
    {
        $result = $this->collection->findOne(array('_id' => new MongoDB\BSON\ObjectID($value)));

        return $result;
    }
   

}