<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\ResponseHelper;

class KeywordRequest extends FormRequest
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
        $unique = Rule::unique('App\Keyword');
        if ($this->route()->hasParameter('keyword')) {
            $unique = $unique->ignore($this->route()->parameters()['keyword']);
        }
        $rules = [
            'word' => ['required', 'string', 'max:32', $unique],
            'description' => 'nullable|string|max:250',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:App\Tag,id'
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        ResponseHelper::abort($responseData);
    }
}
