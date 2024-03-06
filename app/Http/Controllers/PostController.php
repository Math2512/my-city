<?php

namespace App\Http\Controllers;

use App\Models\ActivationLink;
use App\Models\Post;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PostController extends Controller
{


    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $status = Password::sendResetLink([
            'email' => $user->email
        ]);

        $posts = Post::whereIn('group_id', $user->groups->pluck('id'))->orderBy('created_at', 'desc')->get();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->query('group')) {
            $group = Group::find($request->query('group'));
            return view('post.create', ['group' => $group]);
        }
        $userGroups = auth()->user()->groups;
        if ($userGroups->count() === 1) {
            $group = $userGroups->first();
            return view('post.create', ['group' => $group]);
        }

        return $this->selectGroup();
    }

    public function selectGroup()
    {
        $userGroups = auth()->user()->groups;
        return view('post.select_group', ['userGroups' => $userGroups]);
    }

    public function create_with_group(Request $request)
    {
        $group = Group::find($request->group);
        return redirect()->route('articles.create', ['group' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
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
