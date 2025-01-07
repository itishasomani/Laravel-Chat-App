<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class NewChatComponent extends Component
{
    public $user;
    public $chat_user;
    public $sender_id;
    public $receiver_id;
    public $message = "";
    public $messages = [];

    

    public function render()
    {
        return view('livewire.new-chat-component');
    }

    public function mount(){
        $this->user = User::whereId(auth()->user()->id)->first();
        $this->chat_user = Message::with('receiver:id,name')->where('sender_id',auth()->user()->id)->groupBy('receiver_id')->get();
    }
    public function get_chat(){
        dd("hello");
    }
    // public function get_chat(){
    //     dd("hello");
        // $this->sender_id = auth()->user()->id;
        // $this->receiver_id = $user_id;

        // $messages = Message::where(function($q){
        //     $q->where('sender_id',$this->sender_id)
        //     ->where('receiver_id',$this->receiver_id);
        // })->orwhere(function($q){
        //     $q->where('sender_id',$this->receiver_id)
        //     ->where('receiver_id',$this->sender_id);
        // })->with('sender:id,name','receiver:id,name')->get();

        // foreach($messages as $mess){
        //     $this->appendChatMessage($mess);
        // }
    // }

    // public function appendChatMessage($mess){
    //     array_push(
    //         $this->messages,[  'id' => $mess->id,
    //             'message'=>$mess->message,
    //             'sender' => $mess->sender->name,
    //             'receiver' => $mess->receiver->name
    //         ]
    //     );
    // }
}
