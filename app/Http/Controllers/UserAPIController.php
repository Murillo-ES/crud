<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserAPIController extends Controller
{
    // Users List
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    // Return specific user by ID.
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return new UserResource($user);
    }
}
