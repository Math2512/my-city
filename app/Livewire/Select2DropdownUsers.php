<?php

namespace App\Livewire;

use Livewire\Component;

class Select2DropdownUsers extends Component
{
    public $users;
    public $group = null;

    public $selectedOptions = [];

    public function render()
    {
        return view('livewire.select2-dropdown-users', [
            'users' => $this->users,
            'group' => $this->group
        ]);
    }
}
