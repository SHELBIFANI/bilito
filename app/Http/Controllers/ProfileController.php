<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request, User $user)
    {
        $user = $request->user();
        return response()->json($user); 
    }

    public function update(ProfileRequest $request)
    {
        
        $request->user()->fill($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            if ($request->user()->image) {
                Storage::disk('public')->delete($request->user()->image);
            }

            $request->user()->image = $request->file('image')->store('images', 'public');
        }

        $request->user()->save();

        return $request->user();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
