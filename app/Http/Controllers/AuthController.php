<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        // Handle the ID photo upload
        if ($request->hasFile('id_photo')) {
            $path = $request->file('id_photo')->store('id_photos', 'public');
            $validatedData['id_photo'] = $path;
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'place_of_birth' => $validatedData['place_of_birth'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'phone_number' => $validatedData['phone_number'],
            'id_number' => $validatedData['id_number'],
            'id_photo' => $validatedData['id_photo'],
            'monthly_income' => $validatedData['monthly_income'],
            'tax_id_number' => $validatedData['tax_id_number'] ?? null,
        ]);

        $role = Role::where('code', $validatedData['role'])->first();
        $user->assignRole($role);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function profile()
    {
        $user = Auth::user();
        $user->role = $user->getRoleNames()->first();
        // Get the user's role 
        return response()->json($user);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
