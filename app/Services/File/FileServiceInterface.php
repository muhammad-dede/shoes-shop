<?php

namespace App\Services\File;

interface FileServiceInterface
{
    public function upload($file_path, $file, $file_name);
    public function remove($file_path, $file_name);
}
