<?php

use App\Livewire\NewChatComponent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::view('/', 'welcome');

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('learning/ChatApp/public/livewire/update', $handle);
// });

// Livewire::setScriptRoute(function ($handle) {
//     return Route::get('learning/ChatApp/public/livewire/livewire.js', $handle);
// });

Route::get('/dashboard', function(){
    $users = User::where('id','!=',auth()->user()->id)->get();
    $chat_user =  User::where(function($q){
            $q->whereHas('sentMessages',function($q){
                $q->where('receiver_id',auth()->user()->id);
            })
            ->orWhereHas('receivedMessages',function($q){
                $q->where('sender_id',auth()->user()->id);
            });
        })
        ->where('id','!=',auth()->user()->id)
        ->get();
    return view('dashboard',['users' => $users,'chat_user' => $chat_user]);
})->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/chat/{id}', function($id){
    return view('chat',['id'=>$id]);
})->middleware(['auth', 'verified'])
    ->name('chat');  

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
