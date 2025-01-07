<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<div>
    <div class="container mx-auto shadow-lg rounded-lg">
        <!-- headaer -->
        <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
            <div class="font-semibold text-2xl">GoingChat</div>
            <div class="h-14 w-14 p-3 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center">
                {{$user->name}}
            </div>
        </div>
        <!-- end header -->
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white">
            <!-- chat list -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                <!-- search compt -->
                <div class="border-b-2 py-4 px-2">
                    <input type="text" placeholder="search chatting" class="py-2 px-2 border-2 border-gray-200 rounded-2xl w-full" />
                </div>
                <!-- end search compt -->
                <!-- user list -->
                @foreach($chat_user as $users)
                <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2">
                    <div class="w-1/4">
                        <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600" class="object-cover h-12 w-12 rounded-full" alt="" />
                    </div>
                    <div class="w-full">
                        <!-- <button type="button" wire:click="get_chat">{{$users->receiver->name}}</button> -->
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <!-- Toggle button -->
                        <div class="w-15 cursor-pointer pb-4" @click="open = !open">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="absolute right-0 w-48 bg-white border border-gray-200 rounded-md shadow-lg" x-show="open" @click.away="open = false">
                            <!-- Dropdown content -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">&nbsp;Delete</a>

                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end user list -->
            </div>
            <!-- end chat list -->
            <!-- message -->
            <div class="w-full px-5 justify-between">
                
                <div class="flex flex-col mt-5">
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            Welcome to group everyone !
                        </div>
                    </div>
                    <div class="flex justify-start mb-4">
                        <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                            at praesentium, aut ullam delectus odio error sit rem. Architecto
                            nulla doloribus laborum illo rem enim dolor odio saepe,
                            consequatur quas?
                        </div>
                    </div>
                </div>
                <div class="py-5 row">
                    <!-- <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..." /> -->
                    <textarea class="col-10 bg-gray-300 px-3 rounded-xl" rows="1" wire:model="message" placeholder="Message..." style="outline: none;width:90%"></textarea>
                    <button type="submit" class="m-2 col-2" style="outline: none;">
                        <svg class="svg-inline--fa text-green-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z" />
                        </svg>
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</div>