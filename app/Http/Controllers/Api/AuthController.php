<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\UserWithTokenResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{



    public function login(LoginRequest $request)
    {
        $validData =  $request->validated();
        $user = User::where('email', $validData['email'])->first();
        if (!$user) {
            throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return new UserWithTokenResource([$user, $token]);
    }

    public function register(SignUpRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('api-token')->plainTextToken;
        return new UserWithTokenResource([$user, $token]);
    }

    public function signOut(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function profile(Request $request)
    {

        // if (Gate::allows('isAdminUser')) {
        return new UserWithTokenResource([
            $request->user(),
            substr($request->header('Authorization'), 7)
        ]);
    }
}
