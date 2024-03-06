<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tag;

class TagManager extends Component
{
    public $tags = [];
    public $newTag = '';
    public $groupId;

    public function mount($groupId = null)
    {
        $this->groupId = $groupId;
        $this->loadTags();
    }

    public function loadTags()
    {
        if ($this->groupId !== null) {
            $tags = Tag::where('group_id', $this->groupId)->pluck('name')->toArray();
            foreach($tags as $tag){
                $this->tags[] = $tag;
            }
        }
    }

    public function addTag()
    {
        if (!empty($this->newTag)) {
            $tagData = ['name' => $this->newTag];
            if ($this->groupId !== null) {
                $tagData['group_id'] = $this->groupId;
            }
            $this->tags[] = '#'.$this->newTag;
            $this->newTag = '';
        }
    }

    public function removeTag($index)
    {
        if (isset($this->tags[$index])) {
            unset($this->tags[$index]);
            $this->tags = array_values($this->tags);
        }
    }

    public function render()
    {
        //$this->tags = Tag::where('group_id', $this->groupId)->pluck('name')->toArray();
        return view('livewire.tag-manager');
    }
}
