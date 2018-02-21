<?php

namespace App;

use MongoDB;
use App\ParentModel;


// require_once 'DBConnection.php';
// require_once 'session.php';


class Conversation extends ParentModel {

    protected $collection = "conversations";


    public function findforConversation($participant1, $participant2)
    {

        	$query1 = [
            		'participant 1' => $participant1,
            		'participant 2' => $participant2
        	       ];

        	$query1Result = $this->collection->findOne($query1);

        	$query2 = [
            		'participant 1' => $participant2,
            		'participant 2' => $participant1
        	       ];

        	$query2Result = $this->collection->findOne($query2);

        
        if((count($query1Result) <= 0) && (count($query2Result) <=0))
            {
                return true;
            }
        else
            {
                return false;
            }
            	
    }

    public function findOneConvo($participant1, $participant2)
    {

            $query1 = [
                    'participant 1' => $participant1,
                    'participant 2' => $participant2
                ];

            $query1Result = $this->collection->findOne($query1);




            $query2 = [
                    'participant 1' => $participant2,
                    'participant 2' => $participant1
                ];

            $query2Result = $this->collection->findOne($query2);


            if((count($query1Result) >= 0))
                {
                    return $query1Result->_id;
                }

            if((count($query2Result) >=0))
                {
                    return $query2Result->_id;
                }
    }


     public function myconvo($userId)
        {
                $query  = [
                    '$or' => [
                        [
                            'participant 1' => $userId,
                        ],

                        [
                            'participant 2' => $userId
                        ]
                    ]
                ];


                $myconvo = $this->collection->find($query);

                $result = iterator_to_array($myconvo);
                
                return $result;
        }

       

   
  



}