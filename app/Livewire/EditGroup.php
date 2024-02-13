<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;

use LivewireUI\Modal\ModalComponent;

class EditGroup extends ModalComponent
{
    public Group $group;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    public function render()
    {
        return view('livewire.edit-group');
    }
}
