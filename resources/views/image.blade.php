<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $image->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img class="mx-auto" src="{{$image->getShortHotUrl()}}"/>
                <div class="bg-gray-100 p-2 border-b-2">
                    <h2 class="text-xl underline">Uploaded by {{$image->user->name}}</h2>
                    {{$image->created_at->diffForHumans()}}<br/>
                </div>
                {{$image->description}}
                @auth
                    @if(auth()->user() == $image->user)
                        <div x-data="{ open: false }" >
                            <div class="mt-5">
                                <x-jet-danger-button x-on:click="open = ! open">
                                    {{ __('Delete Image') }}
                                </x-jet-danger-button>
                            </div>
                            <div x-show="open" x-on:keydown.escape.window="open = false"
                                 class="fixed inset-0 overflow-y-auto flex items-center z-50">

                                <!-- Copied modal from jetstream and modified because i'm not using livewire for delete ATM -->
                                <div x-show="open" class="fixed inset-0 transform transition-all" x-on:click="open = false">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <div x-show="show" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:mx-auto ">
                                    <div class="px-6 py-4">
                                        <div class="text-lg">
                                            {{ __('Delete Image') }}
                                        </div>
                                        <div class="mt-4">
                                            {{ __('Are you sure you want to delete this image?') }}
                                        </div>
                                    </div>

                                    <form method="POST" id="delete" action="{{ route('deleteImage', $image->id) }}">
                                        @csrf
                                        <div class="px-6 py-4 bg-gray-100 text-right">
                                            <x-jet-secondary-button x-on:click="open = false">
                                                {{ __('Cancel') }}
                                            </x-jet-secondary-button>

                                            <x-jet-danger-button class="ml-2" x-on:click="open = false;
                                            document.getElementById('delete').submit()">
                                                {{ __('Delete Image') }}
                                            </x-jet-danger-button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
