<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($file_path, $file_name)
    {
        // --- Local Storage --- //
        $file = storage_path('app/' . $file_path . '/' . $file_name);
        if (!$file) return abort(404);
        return response()->file($file);

        // --- Minio Storage --- //
        // if (Storage::disk('minio')->missing($file_name)) return abort(404);
        // $path = Storage::temporaryUrl($file_name, now()->addMinutes(5));
        // $path = Storage::disk('minio')->url(config('filesystems.disks.minio.bucket') . '/' . $file_name);
        // $contents = file_get_contents($path);
        // $type = Storage::disk('minio')->mimeType($path);
        // return Response::make($contents, 200, [
        //     'Content-Type' => $type,
        //     'Content-Disposition' => 'inline; filename="' . $file_name . '"',
        // ]);
    }
}
