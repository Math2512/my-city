<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\PostService;
use Livewire\WithFileUploads;
use App\Services\SurveyService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class PostManager extends Component
{
    use WithFileUploads;

    public $files = [];
    public $group;
    public $tags = [];
    #[Validate('required|min:3', message: 'Please provide a post title')]
    public $title = '';
    public $selectedGroup;
    public $selectedTags;
    #[Validate('required|min:3', message: 'Please provide a post description')]
    public $description = '';

    public $isChecked;
    #[Validate('required_if:isChecked,true', message: 'Please provide a start date if evenement')]
    public $startDate;
    public $endDate;

    //Survey
    public $isSurvey;
    public $multiple;
    #[Validate('required_if:isSurvey,true|string|min:3')]
    public $question = '';
    #[Validate('required_if:isSurvey,true|array|min:2')]
    public $responses = [];
    public $deadline;

    protected $listeners = ['responsesUpdated'];

    public function responsesUpdated($inputValues)
    {
        $this->responses = $inputValues;
    }

    public function mount($group)
    {
        $this->group = $group;
        $this->tags = $this->group->tags()->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.post-manager');
    }

    public function deleteToPhotos($index){
        unset($this->files[$index]);
        $this->files = array_values($this->files);
    }

    public function save(PostService $postService, SurveyService $surveyService)
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $post = $postService->savePost(
                $this->title,
                $this->description,
                $this->group,
                $this->selectedTags,
                $this->files,
                $this->isChecked,
                $this->isSurvey,
                $this->startDate,
                isset($this->endDate) ? $this->endDate : $this->startDate
            );

            if($this->isSurvey)
            {
                $survey = $surveyService->saveSurvey($post, $this->multiple, $this->question, $this->responses, $this->deadline);
            }
            DB::commit();

            if ($post) {
                return redirect()->route('articles.index')->with('success', 'Article créé avec succès');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('articles.create')->with('error', 'Problème lors de l\'enregistremet de l\'article');

        }
    }


}
