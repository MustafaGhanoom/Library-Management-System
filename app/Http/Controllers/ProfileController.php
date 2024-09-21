<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    
    $user->fill($request->validated());
    
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        
        // حذف الصورة القديمة إذا كانت موجودة
        if ($user->image) {
            Storage::disk('public')->delete($user->image);  
        }
    
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $imagePath = 'user_images/' . $imageName;    
    
        $image->storeAs('user_images', $imageName, 'public');
    
        $user->image = $imagePath;
    }
    
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    
    
    /**
     * Delete the user's account.
     */
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
