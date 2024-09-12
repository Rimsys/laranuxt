<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

use function Symfony\Component\HttpKernel\EventListener\LocaleAwareListener;

class StoreResumeSkillRequest extends FormRequest
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
            'name' => 'required|string|exists:skills,name',
            'years' => 'required|integer|min:0|max:12',
        ];
    }
}
