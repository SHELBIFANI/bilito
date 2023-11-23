<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        // dd($request->input());
        $request->validate([
            'mobile' => ['required', 'string', 'size:11', 'unique:users', 'iran_mobile'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }
}
