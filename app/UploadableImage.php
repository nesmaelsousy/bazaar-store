<?php

namespace App;
use Illuminate\Support\Facades\Storage;


trait UploadableImage {
    public function uploadImage($request, $folder )
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $imagePath = $request->file('image')->store($folder, 'public');
        return $imagePath;
    }

    public function deleteOldImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    public function updateImage($request, $currentImagePath, $folder )
    {
        $newImage = $this->uploadImage($request, $folder);
        
        if ($newImage) {
            $this->deleteOldImage($currentImagePath);
            return $newImage;
        }
        
        return $currentImagePath;
    }

}
