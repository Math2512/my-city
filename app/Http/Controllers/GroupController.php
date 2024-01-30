<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\PhotoUploadService;

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
        return view('group.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGroupRequest $request)
    {
        try {
            $this->groupService->createGroup($request);
            return redirect()->route('groups.create')->with('success', 'Le diffuser à bien été créé');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}