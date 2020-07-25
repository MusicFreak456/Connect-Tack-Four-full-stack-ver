<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function show(\App\Profile $profile)
    {
        return $profile;
    }

    public function update(Request $request)
    {
        $data = request()->validate([
             'about' => 'required',
             'image' => ''
        ]);

        if($request->file('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imagePath = 'storage/' . $imagePath;
            $imageArray = ['image' => $imagePath];
        }

        $request->user()->profile->update(array_merge(
            $data, 
            $imageArray ?? []
        ));
    }
}
