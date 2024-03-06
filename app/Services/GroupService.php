<?php

namespace App\Services;

use App\Models\Tag;
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


            if (!empty($data['tags'])) {
                foreach ($data['tags'] as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $group->tags()->save($tag);
                }
            }

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

            if ($request->hasFile('group_avatar')) {
                $photo = $this->photoUploadService->upload($request->file('group_avatar'), $group, 'group/');
            }

            $newTagIds = [];
            if (!empty($data['tags'])) {
                $tags = [];
                foreach ($data['tags'] as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    if (!$group->tags->contains($tag)) {
                        $group->tags()->save($tag);
                    }
                    $tags[] = $tag;
                }
                $newTagIds = collect($tags)->pluck('id')->toArray();
            }

            $group->tags()->whereNotIn('id', $newTagIds)->delete();


            DB::commit();
            return $group;
        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
