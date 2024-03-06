<?php

namespace App\Livewire;

use Livewire\Component;

use LivewireUI\Modal\ModalComponent;

class CreateUser extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
