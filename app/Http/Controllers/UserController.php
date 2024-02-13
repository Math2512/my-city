<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\UserGroupService;
use Illuminate\Support\Facades\DB;
use App\Services\PhotoUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $photoUploadService;
    protected $userGroupService;

    public function __construct(PhotoUploadService $photoUploadService, UserGroupService $userGroupService)
    {
        $this->photoUploadService = $photoUploadService;
        $this->userGroupService = $userGroupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        if (auth()->user()->is_admin) {
            $users = User::where('client_id', auth()->user()->client_id)
                        ->where('is_admin', false)
                        ->whereNotIn('id', [auth()->user()->id])
                        ->get();
        }else{
            $groupIds = auth()->user()->groups->pluck('id');
            $users = User::where('client_id', auth()->user()->client_id)
                            ->where('is_admin', false)
                            ->whereNotIn('id', [auth()->user()->id])
                            ->whereHas('linkages', function ($query) use ($groupIds) {
                                $query->whereIn('groupable_id', $groupIds)
                                    ->where('groupable_type', 'App\Models\Group');
                            })
                            ->get();
        }
        return view('user.index', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $groups = Auth::user()->groups;
        return view('user.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'client_id' => auth()->user()->client_id,
                'role' => $data['role'],
            ]);

            if(isset($data['user_groups'])){
                $this->userGroupService->syncUserWithGroups($user, $data['user_groups']);
            }

            $this->photoUploadService->upload($request->file('user_avatar'), $user, 'users/');
            DB::commit();
            return redirect()->route('users.index')->with('success', 'L\'utilisateur à bien été créé');
        } catch (\Exception $e) {
            return redirect()->route('users.create')->with('error', $e->getMessage());
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
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $groups = Auth::user()->groups;
        return view('user.edit', ['user' => $user, 'groups'=>$groups]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $data = $request->validated();

            $user->update($data);

            $management_type = 'redactor';
            if(auth()->user()->is_admin){
                $management_type = 'manager';
            }

            if(!isset($data['user_groups'])){
                $data['user_groups'] = [];
            }
            $this->userGroupService->syncUserWithGroups($user, $data['user_groups'], $management_type);

            $this->photoUploadService->upload($request->file('user_avatar'), $user, 'users/');

            return redirect()->route('users.index')->with('success', 'L\'utilisateur à bien été créé');
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user)->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        if($user->picture){
            $newPath = str_replace('storage', 'public', $user->picture->url);
            Storage::delete($newPath);
            $user->picture->delete();
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
