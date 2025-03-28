<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator; // Add this

class UserController extends Controller
{
    // Get all users
    public function getUsers()
    {
        return response()->json(User::all(), 200);
    }

    // Add a new user
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'in:Male,Female',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => $request->password, // No encryption
            'gender' => $request->gender
        ]);

        return response()->json($user, 201);
    }

    // Get a single user by ID
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::findOrFail($id);
        $user->username = $request->username ?? $user->username;
        $user->password = $request->password ?? $user->password; // No encryption
        $user->gender = $request->gender ?? $user->gender;

        $user->save();

        return response()->json($user);
    }

    // Delete a user
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
