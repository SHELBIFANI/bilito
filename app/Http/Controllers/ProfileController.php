<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return UserResource::make($user); 
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

        return response()->json($request->user());

    }

    public function orders(Request $request)
    {
        return $request->user()->orders()->with(['passengers', 'payment'])->get();
    }
}
