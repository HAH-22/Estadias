<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function upload(?UploadedFile $image, string $directory): ?string
    {
        if (!$image) {
            return null;
        }

        $filename = Str::uuid() . '.' . $image->extension();
        return $image->storeAs($directory, $filename, 'public');
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function replace(?UploadedFile $newImage, ?string $oldPath, string $directory): ?string
    {
        if (!$newImage) {
            return $oldPath;
        }

        $this->delete($oldPath);
        return $this->upload($newImage, $directory);
    }
}