<?php

namespace App\Services;

use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateGroupRequest;
use App\Models\TemporaryFile;
use Illuminate\Database\QueryException;


class GroupService
{
    protected $photoUploadService;

    public function __construct(PhotoUploadService $photoUploadService)
    {
        $this->photoUploadService = $photoUploadService;
    }

    public function createGroup(CreateGroupRequest $request)
    {
        try {
            $data = $request->validated();
            // Create group
            $group =  Group::create($data);

            // Attach group_managers
            //$group->managers()->attach($data['group_managers']);

            // Upload group_avatar
            $temporaryFile = TemporaryFile::where('folder', $request->group_avatar)->first();
            $photo = $this->photoUploadService->upload(storage_path('app/tmp/'.$request->group_avatar.'/'.$temporaryFile->filename), $group);

            return $group;
        } catch (QueryException $e) {
                throw new \Exception($e->getMessage());
        }
    }

    protected function uploadGroupAvatar($file)
    {
        $path = $file->store('group_avatars', 'public');

        return $path;
    }
}
