<?php

namespace App\Services;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;


class UserGroupService
{
    /**
     * @params User $user
     * @params Group $group
     * @params String $management_type
     */
    public function associatedUserWithGroup(User $user, Group $group, string $management_type){
            $linkage = $user->linkages()->create([
                'groupable_id'=> $group->id,
                'groupable_type'=> get_class($group),
                'management_type'=> $management_type,
            ]);

            return $linkage;
    }

    /**
     * Sync users with the given group and management type.
     *
     * @param Group $group
     * @param array $users
     * @return void
     */
    public function syncUsersWithGroup(Group $group, array $users)
    {
        foreach ($users as $user) {
            $user = User::find($user);
            $this->syncUserWithGroup($user, $group);
        }

        // Remove linkages for users not in the provided array
        $group->linkages()->whereNotIn('user_id', $users)->delete();
    }

    /**
     * Sync users with the given user and management type.
     *
     * @param Group $group
     * @param array $users
     * @return void
     */
    public function syncUserWithGroups(User $user, array $groups)
    {
        foreach ($groups as $group) {
            $group = Group::find($group);
            $this->syncUserWithGroup($user, $group);
        }

        // Remove linkages for users not in the provided array
        $test = $user->linkages()->whereNotIn('groupable_id', $groups)->delete();
    }

    /**
     * Sync a single user with the given group and management type.
     *
     * @param User $user
     * @param Group $group
     * @return MorphMany
     */
    public function syncUserWithGroup(User $user, Group $group)
    {
        $existingLinkage = $user->linkages()->where([
            'groupable_id' => $group->id,
            'groupable_type' => get_class($group),
        ])->withTrashed()->first();

        if ($existingLinkage) {
            if ($existingLinkage->trashed()) {
                // If the linkage is soft deleted, restore it
                $existingLinkage->restore();
            }
            // If the linkage exists and is not soft deleted, do nothing
        } else {
            // If no linkage exists, create a new one
            $user->linkages()->create([
                'groupable_id' => $group->id,
                'groupable_type' => get_class($group)
            ]);
        }

        return $user->linkages()->where([
            'groupable_id' => $group->id,
            'groupable_type' => get_class($group),
        ])->first();
    }
}
