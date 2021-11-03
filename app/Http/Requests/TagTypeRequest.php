<?php

namespace App\Http\Requests;

use \Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
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
        $init_rules = [
            'name' => 'required|string|max:32|unique:tag_types'
        ];
        /*if ($this->method() == 'PATCH') {
            foreach($init_rules as $attr => $rules){
                $rules = is_array($rules) ? $rules : explode('|', $val);
                foreach($rules as $rule){
                    [$rule, $params] = ValidationRuleParser::parse($rule);
                    if (strtolower($rule) == 'required'){

                    }
                }
            }
        }*/
        return $init_rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        ResponseHelper::abort($responseData);
    }

    public function getValidatorInstance()
    {
        return parent::getValidatorInstance();
    }
}
