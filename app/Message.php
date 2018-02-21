<?php

namespace App;

use MongoDB;
use App\ParentModel;


// require_once 'DBConnection.php';
// require_once 'session.php';


class Message extends ParentModel {

    protected $collection = "messages";


     public function findOneConvoWithMessages($convoId)
        {
                $query  = [
                    'conversation_id' => $convoId
                ];


                $myconvo = $this->collection->find($query);

                $result = iterator_to_array($myconvo);
                
                return $result;
        }

}