<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/editor', $fileName, 'public');

        return response()->json([
            'success' => true,
            'url' => \Storage::disk('public')->url($path),
            'path' => $path,
        ]);
    }
}
