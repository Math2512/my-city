<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Picture;
use App\Services\PhotoUploadService;

class PostService
{
    protected $photoUploadService;

    public function __construct(PhotoUploadService $photoUploadService)
    {
        $this->photoUploadService = $photoUploadService;
    }

    public function savePost($title, $description, $group, $selectedTags, $files, $ischecked, $isSurvey, $startDate, $endDate)
    {
        $post = new Post();
        $post->title = $title;
        $post->content = $description;
        $post->client_id = auth()->user()->client_id;
        if($ischecked){
            $post->event = $ischecked;
        }
        if($isSurvey){
            $post->survey = $isSurvey;
        }
        if(isset($startDate) && $startDate != '')
        {
            $post->started_at = $startDate;
            $post->ended_at = $endDate;
        }
        $post->author_id = auth()->user()->id;

        if ($group) {
            $post->group_id = $group->id;
        }

        $post->save();

        if ($selectedTags) {
            $post->tags()->sync($selectedTags);
        }


        foreach ($files as $photo) {
            $photo->storeAs('public/photos/'.auth()->user()->client_id.'/'.$group->id.'/'.$post->id, $photo->getClientOriginalName());
            $picture = new Picture([
                'url' => 'storage/photos/'.auth()->user()->client_id.'/'.$group->id.'/'.$post->id.'/'.$photo->getClientOriginalName(),
                'imageable_id' => $post->id,
                'imageable_type' => get_class($post),
            ]);
            $post->pictures()->save($picture);
        }

        return $post;
    }
}
