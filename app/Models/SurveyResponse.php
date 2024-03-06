<?php

namespace App\Models;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = ['survey_id', 'body'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
