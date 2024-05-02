<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // echo ($request);
        // $validData =  $request->validated();

        // // dd("", $validData);
        // $user = User::where('email', $validData['email'])->first();
        // if (!$user) {
        //     throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        // }
        // if (!Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        // }
        // $token = $user->createToken('api-token')->plainTextToken;
        // return redirect()->route("auth.signup");
        // return response()->json(['message' => 'Login successful'], 200);


        // localStorage.setItem('auth_token', data.token);

        return redirect()->route('auth.signup');
    }

    public function loginCheck(LoginRequest $request)
    {
        return redirect()->route('auth.signup');
    }
}
