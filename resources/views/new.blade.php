<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form method="POST" enctype="multipart/form-data" action="{{ route('upload') }}">
                    @csrf
                    <div class="py-5">
                        <label class="mb-1 flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-lg px-2 py-2">
                            <span class="w-full text-center">Select file</span>
                            <input type="file" class="hidden" name="file" id="file"
                               onchange="document.getElementById('title').value = document.getElementById('file').files[0].name"/>
                        </label>
                        @error('file')
                        <div class="font-bold bg-red-100">{{ $message }}</div>
                        @enderror

                        <input id="title" name="title" type="text" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-8 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" placeholder='Title (will be original filename if left blank)'/>
                        @error('title')
                        <div class="font-bold bg-red-100">{{ $message }}</div>
                        @enderror
                        <textarea name="description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='(Optional) give a description'></textarea>
                        @error('description')
                        <div class="font-bold bg-red-100">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="nsfw" value="0">
                        <input type="checkbox" id="nsfw" name="nsfw" value="1" class="mt-1 rounded bg-blue-500 font-bold py-4 px-4"/>
                        <label for="nsfw">Mark as NSFW?</label>
                        @error('nsfw')
                        <div class="font-bold bg-red-100">{{ $message }}</div>
                        @enderror
                    </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload Image</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
