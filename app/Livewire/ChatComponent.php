<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatComponent extends Component
{
    use WithFileUploads;
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = "";
    public $file = null;
    public $messages = [];

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($user_id){
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = Message::where(function ($query) {
            $query->where(function ($q) {
                $q->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
            })->orWhere(function ($q) {
                $q->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
            });
        })
        ->where(function ($q) {
            $q->where(function ($q) {
                $q->where('deleted_by', '!=', auth()->user()->id)
                ->where('deleted_by', '!=', 'both');
            })
            ->orWhereNull('deleted_by');
        })
        ->with('sender:id,name', 'receiver:id,name')
        ->get();

        // dd($messages->toRawSql());

        foreach ($messages as $mess) {
            $this->appendChatMessage($mess);
        }
        $this->user = User::whereId($user_id)->first();
    }

    public function sendMessage(){
        $chatMessage = new Message();
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->message = $this->message;
        $attachmentPath = null;

        if ($this->file) {
            $attachmentPath = $this->file->store('attachment', 'public');
        }
        $chatMessage->attachment = $attachmentPath;
        $chatMessage->save();

        $this->appendChatMessage($chatMessage);
        //without refresh message will display
        broadcast(new MessageSendEvent($chatMessage))->toOthers();

        $this->message =  '';
        $this->file = null;
    }

    //Listner for receiver
    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listenForMessage($event){
        $chatMessage = Message::whereId($event['message']['id'])
        ->with('sender:id,name','receiver:id,name')
        ->first();
        $this->appendChatMessage($chatMessage);
    }

    public function appendChatMessage($mess){
        array_push(
            $this->messages,[  'id' => $mess->id,
                'message'=>$mess->message,
                'sender' => $mess->sender->name,
                'receiver' => $mess->receiver->name,
                'attachment' => $mess->attachment
            ]
        );
    }

    public function delete_chat(){
        $messagess  = Message::where(function ($q) {
            $q->where('sender_id', $this->sender_id)
              ->where('receiver_id', $this->receiver_id)
            ->orWhere(function ($q) {
                $q->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
            });
        })
        ->get();


        foreach($messagess as $mes){
            if($mes->deleted_by == null){
                $mes->deleted_by = auth()->user()->id;
            }
            else{
                $mes->deleted_by = 'both';
            }
            $mes->save();
        }

        // // Reload the messages
        // $this->mount($this->receiver_id);
    }
}