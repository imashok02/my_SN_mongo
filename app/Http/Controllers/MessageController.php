<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Conversation;
use App\Message;
use App\User;
use MongoDB;

class MessageController extends Controller
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
    public function store(Request $request, $sendTo)
    {
        $this->validate($request, [
        
            'message' => 'required'    
        ]);

        $user = new User;
       
        $conversation = new Conversation();



        $find = $conversation->findforConversation($user->auth_user()->_id, $sendTo);
    
//if theres no conversation created creating a new conversation here


        if($find == true)
        {
             $values = [

            'participant 1' => $user->auth_user()->_id,
            'participant 2' => $request->sendTo,
            'created_at' => time()
        ];

        $result = $conversation->insertId($values);
        }



//if theres already a conversation  finding the conversation id and adding a message to that civersation id


        else{
             $find = $conversation->findOneConvo($user->auth_user()->_id, $sendTo);


            $message = new Message;


            $values = [

                'sender' => $user->auth_user()->_id,
                'message' => $request->message,
                'conversation_id' => $find,
                'created_at' => time()
            ];

            $message_result = $message->insertId($values);

            return $message_result;

     //message created for new conversation
        if($result)
        {
            $message = new Message;


            $values = [

                'sender' => $user->auth_user()->_id,
                'message' => $request->message,
                'conversation_id' => $result,
                'created_at' => time()
            ];

            $message_result = $message->insertId($values);

            return $message_result;
        }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($conversationId)
    {
        $conversation = new Conversation;

        $message = new Message;

        $ok = $conversation->findOneId($conversationId);

        $messages_for_this_conversation = $message->findOneConvoWithMessages($ok->_id);


        return $messages_for_this_conversation;
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
             'interest_category_id' => $request->interest_category_id
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

    public function my_conversations()
    {
        $user = new User;
        $conversation = new Conversation;

        $my_conversations = $conversation->myconvo($user->auth_user()->_id);

       return $my_conversations;
       
    }


    public function my_messages()
    {
        $user = new User;
        $message = new Message;



        $my_messages = $message->all();

        return $my_messages;
    }

}
