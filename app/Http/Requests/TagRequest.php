<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\ResponseHelper;

class TagRequest extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $unique = Rule::unique('App\Tag');
        if ($this->route()->hasParameter('tag')) {
            $unique = $unique->ignore($this->route()->parameters()['tag']);
        }
        $rules = [
            'name' => ['required', 'string', 'max:32', $unique],
            'description' => 'nullable|string|max:250',
            'type' => 'nullable|integer|exist:App\TagType,id',
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        ResponseHelper::abort($responseData);
    }
}
