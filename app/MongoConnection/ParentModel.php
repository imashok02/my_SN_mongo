<?php

namespace App;

use App\DBConnection;
use MongoDB;

class ParentModel {

	const COLLECTION = "";
    private $_mongo;
    protected $collection= "";
    private $user;

	public function __construct() 
    {
        $this->_mongo = DBConnection::instantiate();
        $this->collection = $this->_mongo->getCollection($this->collection);

    }


     public function all() 
    {
          $result = $this->collection->find();

          $ok = iterator_to_array( $result);

          return $ok;    
    }


    public function insertId($values) 
    {
        $result = $this->collection->insertOne($values);

        return $result->getInsertedId();
    }

// its working

    public function findOneRequestor($requestor)
    {
        $result = $this->collection->findOne(array('requestor' => $requestor));

        return $result;
    }

    public function findRequestorWithstatus0($requestor)
    {
        $result = $this->collection->find(array('userRequestedTo' => $requestor, 'status' => 0));

        $final = iterator_to_array($result);

        return $final;
    }

     public function findRequestorWithstatus1($requestor)
    {
        $result = $this->collection->find(array('requestor' => $requestor, 'status' => 1));

        $final = iterator_to_array($result);

        return $final;
    }



    public function findUserRequestFromWithstatus1($requestor)
    {
        $result = $this->collection->find(array('userRequestedTo' => $requestor, 'status' => 1));

        $final = iterator_to_array($result);

        return $final;
    }


    public function findOneId($id) 
    {

        $result = $this->collection->findOne(array('_id' => new  MongoDB\BSON\ObjectID($id)));

       return $result;
    }

     public function findOneApi($value) 
    {

        $result = $this->collection->findOne(array('api_key' => $value));

       return $result;
    }

    public function findOnePost($value) 
    {

        $result = $this->collection->findOne(array('post_id' =>($value)));

       return $result;
    }

     public function findPost($value) 
    {

        $result = $this->collection->find(array('post_id' =>($value)));

       return iterator_to_array($result);
    }

    public function findOneProfile($value) 
    {

        $result = $this->collection->findOne(array('profile_id' =>($value)));

       return $result;
    }

    public function findforUser($user_id)
    {
        $result = $this->collection->find(array('user_id' =>($user_id)));

       return $result;
    }


//end its working 

    public function updateOneId($id, $values)
    {
        $result = $this->collection->updateOne(array('_id' => new  MongoDB\BSON\ObjectID($id)),array('$set' => $values) );

        return response()->json('Updated Successfully');
    }

    // its working

    public function deleteOneId($id)
    {
        $result = $this->collection->deleteOne(array('_id' => new MongoDB\BSON\ObjectID($id)));
        return $result->getDeletedCount();
    }
    //its working


    public function embedd($id, $values) 
    {
        $embedd = $this->collection->findOne(array('_id' => new MongoDB\BSON\ObjectID($id)));
        $values = $values;

        $embeddeddoc = $this->collection->updateOne(array('_id' => new MongoDB\BSON\ObjectID($id)), array('$push' => array('comments' => $values)));

        return true;

    }


    public function is_valid_post($value)
    {
        $result = $this->collection->findOne(array('post_id' =>  new MongoDB\BSON\ObjectID($value)));

        return $result;
    }



}




