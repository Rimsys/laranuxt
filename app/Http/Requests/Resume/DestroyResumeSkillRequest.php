<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Log;

use function Symfony\Component\HttpKernel\EventListener\LocaleAwareListener;

class DestroyResumeSkillRequest extends FormRequest
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
        ];
    }
}
