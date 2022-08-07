<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|string|email',
            'location' => 'required|string|max:191',
            'headline' => 'required|string|max:191',
            'professional_summary' => 'required|string',
            'github_url' => 'required',
            'linkedin_url' => 'required',
            'interests' => 'required',
        ];
    }
}
