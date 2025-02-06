<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserAPIController extends Controller
{
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return new UserResource($user);
    }
}
