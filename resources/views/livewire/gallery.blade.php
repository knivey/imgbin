<div>
<div class="grid grid-cols-3 md:grid-cols-5 grid-flow-row gap-1">
    @foreach($images as $image)
        <div class="p-2 bg-gray-300 rounded">
            <a href="{{route('viewImage', $image->shortid)}}">
                <img src="{{Storage::url($image->getThumb())}}"/>
            </a>
            <div class="flex grid-cols-2">
                <div class="flex-grow truncate">{{$image->title}}</div>
                <div class="flex-none justify-self-end">by
                    <a href="{{route('userImages', $image->user->name)}}">{{$image->user->name}}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $images->links() }}
</div>
