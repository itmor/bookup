<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage as StorageFacade;
use App\Models\Storage;

class FileHelper
{
    const FileDir = 'files/';

    public static function add($base64File): int
    {
        $fileContents = base64_decode($base64File);

        $filename = uniqid();

        StorageFacade::put(self::FileDir . $filename, $fileContents);

        $storageEntry = new Storage();
        $storageEntry->filename = $filename;
        $storageEntry->save();

        return $storageEntry->id;
    }

    public static function get($id): string
    {
        $fileInfo = Storage::find($id);

        if (!$fileInfo) {
            return null;
        }

        $fileContents = StorageFacade::get(self::FileDir . $fileInfo->filename);

        $base64File = base64_encode($fileContents);

        return $base64File;
    }
}
