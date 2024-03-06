<?php
namespace App\Services;

use App\Models\Survey;
use App\Models\SurveyResponse;

class SurveyService
{
    public function saveSurvey($post, $multiple, $question, $responses, $deadline)
    {
        $survey = new Survey();
        $survey->post_id = $post->id;
        $survey->multiple_choices = isset($multiple) ? $multiple : false;
        $survey->question = $question;
        $survey->deadline = $deadline;

        $survey->save();

        foreach ($responses as $response) {
            $surveyResponse = new SurveyResponse();
            $surveyResponse->survey_id = $survey->id;
            $surveyResponse->body = $response;
            $surveyResponse->save();
        }

        return $survey;
    }
}
