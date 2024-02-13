<?php

namespace App\Livewire;

use Livewire\Component;

class Select2DropdownGroups extends Component
{
    public $groups;
    public $user = null;

    public $selectedOptions = [];

    public function render()
    {
        return view('livewire.select2-dropdown-groups', [
            'groups' => $this->groups,
            'user' => $this->user
        ]);
    }
}
