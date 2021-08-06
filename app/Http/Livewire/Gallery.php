<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Image;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination;

    public $user;

    public function render()
    {
        if(isset($this->user)) {
            $images = User::find($this->user)->images()->orderByDesc('created_at')->paginate(20);
        } else {
            $images = Image::orderByDesc('created_at')->paginate(20);
        }
        return view('livewire.gallery', ['images'=>$images]);
    }
}
