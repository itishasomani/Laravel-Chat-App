<div>
    <div style="overscroll-behavior: none;">
        <div class="fixed w-full bg-green-400 h-16 pt-2 text-white flex justify-between shadow-md" style="top:0px; overscroll-behavior: none;">
            <!-- back button -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <a href="/dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 my-1 text-green-100 ml-2">
                    <path class="text-green-100 fill-current" d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z" />
                </svg>
            </a>
            <div class="my-3 text-green-100 font-bold text-lg tracking-wide">{{$user->name}}</div>
            <!-- 3 dots -->
            <div class="relative" x-data="{ open: false }">
                <!-- Toggle button -->
                <div class="w-15 cursor-pointer pb-4" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-dots-vertical w-8 h-8 mt-2 mr-2">
                        <path class="text-green-100 fill-current" fill-rule="evenodd" d="M12 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                    </svg>
                </div>

                <!-- Dropdown menu -->
                <div class="absolute right-0 w-48 bg-white border border-gray-200 rounded-md shadow-lg" x-show="open" @click.away="open = false">
                    <!-- Dropdown content -->
                    <button type="button" wire:click="delete_chat" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">&nbsp;Delete</button>
                </div>
            </div>
        </div>

        <div class="mt-20 mb-16">
            @foreach($messages as $message)
                <div class="clearfix">
                    @if($message['sender'] != auth()->user()->name)
                        <div class="flex items-start mx-4 my-2">
                            <div class="flex-shrink-0">
                                @if ($message['attachment'])
                                    <img src="{{ asset('storage/' . $message['attachment']) }}" class="h-20 w-22 rounded-full" alt="Attachment">
                                @endif
                            </div>
                            <div class="ml-3">
                                <div class="bg-gray-300 rounded-lg p-2">
                                    <small><b>{{ $message['sender'] }}:</b></small>
                                    <div class="mt-1">
                                        <p class="break-all">{{ $message['message'] }}</p>
                                        @if ($message['attachment'])
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $message['attachment']) }}" class="text-blue-500 hover:text-blue-700">Download</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-end mx-4 my-2">
                            <div class="bg-green-300 rounded-lg p-2">
                                <div class="mt-1">
                                    @if ($message['message'])
                                        <p class="break-all">{{ $message['message'] }}</p>
                                    @endif
                                    @if ($message['attachment'])
                                        <img src="{{ asset('storage/' . $message['attachment']) }}" class="h-25 w-15 rounded-full" alt="Attachment">
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $message['attachment']) }}" class="text-blue-500 hover:text-blue-700 block">Download</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <form wire:submit="sendMessage()">
        <div class="fixed w-full flex justify-between bg-green-100" style="bottom: 0px;">
            <textarea class="flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 bg-gray-200 resize-none" rows="1" wire:model="message" placeholder="Message..." style="outline: none;"></textarea>
            <label for="file-upload" class="m-2 cursor-pointer" style="outline: none;">
                <svg class="svg-inline--fa text-green-400 fa-paperclip fa-w-16 w-12 h-12 py-2 mr-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paperclip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M192 416c-17.7 0-32-14.3-32-32V192c0-53 43-96 96-96s96 43 96 96v192c0 26.5-21.5 48-48 48s-48-21.5-48-48V238.9c0-4.4-3.6-8-8-8s-8 3.6-8 8V352c0 17.7 14.3 32 32 32s32-14.3 32-32V208c0-35.3-28.7-64-64-64s-64 28.7-64 64v176c0 52.9 43.1 96 96 96s96-43.1 96-96V192c0-70.7-57.3-128-128-128s-128 57.3-128 128v192c0 44.1 35.9 80 80 80s80-35.9 80-80V224c0-4.4-3.6-8-8-8s-8 3.6-8 8v160c0 26.5-21.5 48-48 48s-48-21.5-48-48V160c0-61.9 50.1-112 112-112s112 50.1 112 112v224c0 35.3-28.7 64-64 64s-64-28.7-64-64V224c0-17.7 14.3-32 32-32s32 14.3 32 32v160c0 8.8-7.2 16-16 16s-16-7.2-16-16V256c0-8.8 7.2-16 16-16s16 7.2 16 16v128c0 26.5-21.5 48-48 48s-48-21.5-48-48V160c0-52.9 43.1-96 96-96s96 43.1 96 96v224c0 44.1-35.9 80-80 80s-80-35.9-80-80V192c0-26.5 21.5-48 48-48s48 21.5 48 48v192c0 17.7-14.3 32-32 32z"></path>
                </svg>
            </label>
            <input id="file-upload" type="file" wire:model="file" class="hidden" style="outline: none;">
            <button type="submit" class="m-2" style="outline: none;">
                <svg class="svg-inline--fa text-green-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z" />
                </svg>
            </button>
        </div>
    </form>
</div>
