<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\ResponseHelper;

class TagTypeRequest extends FormRequest
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
        $table = 'tag_types';
        if ($this->route()->hasParameter('tag_type')) {
            $param = $this->route()->parameters()['tag_type'];
            $table =  $param instanceof Model ? $param->getTable() : $table;
            $unique = Rule::unique($table)->ignore($param);
        } else {
            $unique = Rule::unique($table);
        }
        $rules = [
            'name' => ['required', 'string', 'max:32', $unique]
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        ResponseHelper::abort($responseData);
    }
}
