<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255  ',
            'description' => 'nullable|string',
            'group_avatar' => 'nullable|image',
            'group_managers' => 'nullable|array',
            'tags' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Merci de remplir un nom.',
            'activity.required' => 'Merci de remplir un type d\'activitée.',
        ];
    }
}
