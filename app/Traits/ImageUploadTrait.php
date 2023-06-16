<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{
    /**
     * Uploads a single image to the specified disk and returns its path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param string|null $disk
     * @return string
     */


    public function uploadImage(UploadedFile $file, string $folder = null, bool $crop = false, string $disk = null): string
    {
        if (is_null($folder) or empty($folder)) {
            $folder = 'images';
        }

        $disk = $disk ?? config('filesystems.default');
        $path = $file->store($folder, $disk);

        $url = Storage::disk($disk)->url($path);

        if ($crop) {
            $fullPath = Storage::disk($disk)->path($path);
            $this->cropImage($fullPath, 1920, 1080);
        }

        return $path;
    }

    /**
     * Uploads multiple images to the specified disk and returns their paths.
     *
     * @param array $files
     * @param string $folder
     * @param string|null $disk
     * @return array
     */
    public function uploadMultipleImages(array $files, string $folder = null, bool $crop = false, string $disk = null): array
    {
        if (is_null($folder)) {
            $folder = 'images';
        }
        $disk = $disk ?? config('filesystems.default');

        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->uploadImage($file, $folder, $crop,  $disk);
        }
        return $paths;
    }

    /**
     * Crops an image using Intervention Image library.
     *
     * @param string $path
     * @param int $width
     * @param int $height
     * @return string
     */
    private function cropImage(string $path, int $width,  int $height): void
    {
        $image = Image::make($path);
        $image->resize($width, $height, function($constraint) {$constraint->aspectRatio();});
        $image->save();
    }
}
