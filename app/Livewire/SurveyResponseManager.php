<?php

namespace App\Livewire;

use Livewire\Component;

class SurveyResponseManager extends Component
{
    public $responses = [];
    public $newResponse = '';

    public function addResponse()
    {
        if (!empty($this->newResponse)) {
            $this->responses[] = $this->newResponse;
            $this->dispatch('responsesUpdated', $this->responses);
            $this->newResponse = '';
        }
    }

    public function removeResponse($index)
    {
        if (isset($this->responses[$index])) {
            unset($this->responses[$index]);
            $this->responses = array_values($this->responses);
        }
    }
    public function render()
    {
        return view('livewire.survey-response-manager');
    }
}
