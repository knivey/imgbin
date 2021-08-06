<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class IndexController extends Controller
{
    public function __invoke() {
        if(auth()->user() !== null) {
            return view('gallery');
        }
        return view('welcome');
    }
}
