<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller
{
    public function edit(Request $request): View
    {
        dd($request);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);

    }

    public function update(EditProfileRequest $request)
    {
        
        
        $request->user()->fill($request->safe()->except('image'));

        dd($request->file());
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
