<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FroalaController extends Controller
{
    public function upload(Request $request)
    {
        if($request->file('upload')) {
            $processed_image = process_image($request->file('upload'), 'froala');

            $url = asset('storage/froala/' . $processed_image);
            
            return response()->json([
                'link' => $url
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function delete(Request $request)
    {
        $src = $request->src;
        $relative_path = Str::after($src, '/storage/');
        $deleted = Storage::disk('public')->delete($relative_path);

        $thumbnail_path = Str::replaceFirst(
            'froala/',
            'froala/thumbnails/',
            $relative_path
        );

        $deleted_thumb = Storage::disk('public')->delete($thumbnail_path);

        return response()->json([
            'deleted' => $deleted,
            'deleted_thumb' => $deleted_thumb
        ]);
    }
}