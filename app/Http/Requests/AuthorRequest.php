<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\ResponseHelper;

class AuthorRequest extends FormRequest
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
        $unique = Rule::unique('App\Author');
        if ($this->route()->hasParameter('author')) {
            $unique = $unique->ignore($this->route()->parameters()['author']);
        }
        $rules = [
            // 'userid' => ['required', 'string', 'max:32', $unique],
            // 'name' => 'string|max:32',
            'url' => 'nullable|url|max:255',
            'profile_img' => 'nullable|url|max:255',
            'blocked' => 'nullable|boolean'
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        ResponseHelper::abort($responseData);
    }
}
