<?php

namespace App\Observers;

use App\Models\Linkage;
use Illuminate\Support\Facades\Auth;

class LinkageObserver
{
    /**
     * Handle the Linkage "created" event.
     */
    public function creating(Linkage $linkage): void
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $linkage->management_type = Linkage::STATUS_MANAGER;
        }
        else if (Auth::check() && Auth::user()->user_profil() == 'manager') {
            $linkage->management_type = Linkage::STATUS_REDACTOR;
        }
        else{
            $linkage->management_type = Linkage::STATUS_USER;
        }
    }

    /**
     * Handle the Linkage "updated" event.
     */
    public function updated(Linkage $linkage): void
    {
        //
    }

    /**
     * Handle the Linkage "deleted" event.
     */
    public function deleted(Linkage $linkage): void
    {
        //
    }

    /**
     * Handle the Linkage "restored" event.
     */
    public function restored(Linkage $linkage): void
    {
        //
    }

    /**
     * Handle the Linkage "force deleted" event.
     */
    public function forceDeleted(Linkage $linkage): void
    {
        //
    }
}
