<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\GroupService;
use Illuminate\Support\Facades\DB;
use App\Services\PhotoUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateGroupRequest;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Group::class);
        $groups = Auth::user()->groups;
        return view('group.index', ['groups'=> $groups]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Group::class);
        $users = Auth::user()->client->users->where('is_admin', false);
        return view('group.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGroupRequest $request)
    {
        try {
            $this->groupService->createGroup($request);
            return redirect()->route('groups.index')->with('success', 'Le diffuseur à bien été créé');
        } catch (\Exception $e) {
            return redirect()->route('groups.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        $users = Auth::user()->client->users->where('is_admin', false);
        return view('group.edit', ['group'=>$group, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateGroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);
        try {
            $this->groupService->updateGroup($group, $request);
            return redirect()->route('groups.index')->with('success', 'Le diffuseur à bien été créé');
        } catch (\Exception $e) {
            return redirect()->route('groups.edit', $group)->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::find($id);
        $this->authorize('delete', $group);

        if($group->picture){
            $newPath = str_replace('storage', 'public', $group->picture->url);
            Storage::delete($newPath);
            $group->picture->delete();
        }
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Channel supprimé avec succès.');
    }
}
