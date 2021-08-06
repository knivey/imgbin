<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as IImage;

class ImageController extends Controller
{
    use AuthorizesRequests;

    public function new() {
        return view('new');
    }

    public function viewImage(Image $image) {
        return view('image', ['image'=>$image]);
    }

    public function hotImage(Image $image) {
        return response(Storage::get("public/{$image->getImg()}"), 200)
            ->header("Content-Type", Storage::mimeType("public/{$image->getImg()}"));
    }

    public function userImages(User $user) {
        return view('gallery', ['user'=>$user->id,
            'title'=>"Uploads from {$user->name}"]);
    }

    public function destroy(Request $request, Image $image) {
        $this->authorize('destroy', $image);

        $image->delete();
        return route("gallery");
    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'title' => 'max:128',
            'description' => 'max:9048',
            'nsfw' => 'boolean',
        ]);
        $path = $request->file('file')->store('public/images');

        $fullpath = storage_path("app/$path");
        $img = IImage::make($fullpath)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->crop(300,300);
        $thumbpath = "thumbs/". basename($path);
        $img->save(storage_path("app/public/$thumbpath"));
        $img->pixelate(20)->blur(100);
        $img->save(storage_path("app/public/blur_$thumbpath"));

        if(!$path) {
            return redirect('/error'); //TODO real error
        }
        $bytes = 3;
        $cnt = 0;
        do {
            //maybe overkill but dont want to spin if the id range gets full
            if($cnt++ > 5) {
                $bytes += 2;
                $cnt = 0;
            }
            $shortid = bin2hex(random_bytes($bytes));
        } while (Image::where("shortid", $shortid)->exists());
        $image = new Image();
        if(isset($request->description)) {
            $image->description = $request->description;
        }
        $image->user_id = auth()->user()->id;
        $image->shortid = $shortid;
        $image->filename = basename($path);
        $image->nsfw = $request->nsfw;

        if(isset($request->title))
            $image->title = $request->title;
        else
            $image->title = $request->file('file')->getClientOriginalName();
        $image->save();
        return redirect('/'); //TODO redirect to image's page
    }
}
