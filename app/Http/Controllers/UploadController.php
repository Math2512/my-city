<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use App\Services\PhotoUploadService;

class UploadController extends Controller
{
    protected $photoUploadService;

    public function __construct(PhotoUploadService $photoUploadService)
    {
        $this->photoUploadService = $photoUploadService;
    }
    public function store(Request $request){
        if ($request->hasFile('group_avatar')) {
            $folder = uniqid().'-'.now()->timestamp;
            $file = $request->file('group_avatar');
            $filename = $file->getClientOriginalName();
            $file->storeAs('tmp/'.$folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);
            return $folder;
        }

        return '';
    }
}
