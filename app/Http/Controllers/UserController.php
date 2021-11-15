<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        if (!$user->save()) {
            return response()->json(['error' => 'Something went wrong']);
        }

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::guard('api')->user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!$user->save()) {
            return response()->json(['error' => 'User saving error']);
        }

        return response()->json($user);
    }

    public function delete(Request $request)
    {

        $delete = Auth::user()->delete();

        return response()->json(['success' => 'Deleted']);
    }
}
