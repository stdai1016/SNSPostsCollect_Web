<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\ResponseHelper;

class PostRequest extends FormRequest
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
        $rules = [
            'author_id' => 'required|integer|exist:App\Author,id',
            'replied_to' => 'nullable|integer|exist:App\Post,id',
            'text' => 'nullable|string|max:250',
            'referred_to' => 'nullable|url|max:255',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:App\Tag,id',
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
