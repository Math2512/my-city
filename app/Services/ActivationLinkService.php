<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ConfirmationMail;
use App\Models\ActivationLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;


class ActivationLinkService
{
    public function generateActivationLink(User $user)
    {
        $token = Str::random(60);

        $activationLink = new ActivationLink([
            'user_id' => $user->id,
            'token' => $token
        ]);
        $activationLink->save();

        return $activationLink;
    }

    public function sendActivationEmail(User $user)
    {
        $activationLink = $this->generateActivationLink($user);

        Mail::to($user->email)->send(new ConfirmationMail($activationLink));
    }
}
