<?php

namespace App\Models;

use App\Models\Post;
use App\Models\SurveyResponse;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['multiple_choices', 'question', 'deadline', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function survey_response()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
