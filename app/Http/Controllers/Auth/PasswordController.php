<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make ($request->all(), [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        if ($validator->fails()) {
          return back()
            ->withErrors($validator)
            ->withInput()
            ->with('active_tab', 'password');
        }

        $validated = $validator->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()
          ->with('status', 'Votre mot de passe a été modifié 😊')
          ->with('active_tab', 'about');
    }
}
