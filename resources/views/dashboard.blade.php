<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-8">
        <div>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h6>All Users</h6>
                    @foreach($users as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-3">
                        <p><a href="{{ route('chat', $user->id) }}">{{ $user->name }}</a></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h6>Users Chatting with Admin</h6>
                    @if(count($chat_user) > 0)
                    @foreach($chat_user as $message)

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-3">
                            <p><a href="{{ route('chat', $message->id) }}">{{ $message->name }}</a></p>
                            <!-- Optionally, you can display additional information about the chat -->
                        </div>
                    @endforeach
                    @else 
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 my-3">
                            <p>No user found</p>
                            <!-- Optionally, you can display additional information about the chat -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
