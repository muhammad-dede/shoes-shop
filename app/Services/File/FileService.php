<?php

namespace App\Services\File;

use App\Services\File\FileServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceInterface
{
    public function upload($file_path, $file, $file_name)
    {
        // Local Storage
        return  Storage::disk('local')->put('/' . $file_path . '/' . $file_name, File::get($file));

        // Minio Storage
        // return  Storage::disk('minio')->put($file_name, File::get($file));
    }

    public function remove($file_path, $file_name)
    {
        // Local Storage
        if (Storage::disk('local')->exists($file_path . '/' . $file_name)) {
            Storage::disk('local')->delete($file_path . '/' . $file_name);
        }

        // Minio Storage
        // if (Storage::disk('minio')->exists($file_name)) {
        //     Storage::disk('minio')->delete($file_name);
        // }
        return;
    }
}
