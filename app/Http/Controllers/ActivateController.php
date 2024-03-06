<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ActivationLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ActivateController extends Controller
{
    public function activate($token)
    {
        $activationLink = ActivationLink::where('token', $token)->latest()->first();
        if(!isset($activationLink) || $activationLink->validated == false){
            return view('activate.invalid-link');
        }

        $user = $activationLink->user;
        return view('activate.reset-password',compact('user'));
    }



    /**
     * Update the user's password.
     */
    public function password_activate(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        $user = User::find($request->user);

        $user->update([
            'password' => Hash::make($validated['password']),
            'email_verified_at' => Carbon::now()
        ]);

        ActivationLink::where('user_id', $user->id)->update(['validated' => false]);
        return redirect()->route('login')->with('success', 'Votre mot de passe à été mise à jours');
    }
}
