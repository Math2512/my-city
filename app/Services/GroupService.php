<?php

namespace App\Services;

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\CreateGroupRequest;


class GroupService
{
    protected $photoUploadService;
    protected $userGroupService;

    public function __construct(PhotoUploadService $photoUploadService, UserGroupService $userGroupService)
    {
        $this->photoUploadService = $photoUploadService;
        $this->userGroupService = $userGroupService;
    }

    public function createGroup(CreateGroupRequest $request)
    {
        try {
            $data = $request->validated();

            // Create group
            $client_id = auth()->user()->client_id;
            DB::beginTransaction();
            $group =  Group::create(array_merge($data, ["client_id" => $client_id]));

            // Attach group_managers
            $management_type = 'redactor';
            if(auth()->user()->is_admin){
                $management_type = 'manager';
            }
            if(isset($data['group_managers'])){
                $this->userGroupService->syncUsersWithGroup($group, $data['group_managers'], $management_type);
            }
            // Upload group_avatar
            $photo = $this->photoUploadService->upload($request->file('group_avatar'), $group, 'group/');

            DB::commit();
            return $group;
        } catch (QueryException $e) {
                throw new \Exception($e->getMessage());
        }
    }

    public function updateGroup(Group $group, CreateGroupRequest $request)
    {
        try {
            $data = $request->validated();

            DB::beginTransaction();
            // Mettre à jour les propriétés du groupe
            $group->update($data);

            $management_type = 'redactor';
            if(auth()->user()->is_admin){
                $management_type = 'manager';
            }

            if(!isset($data['group_managers'])){
                $data['group_managers'] = [];
            }
            $this->userGroupService->syncUsersWithGroup($group, $data['group_managers'], $management_type);

            // Mettre à jour group_avatar si nécessaire
            if ($request->hasFile('group_avatar')) {
                $photo = $this->photoUploadService->upload($request->file('group_avatar'), $group, 'group/');
            }

            DB::commit();
            return $group;
        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
