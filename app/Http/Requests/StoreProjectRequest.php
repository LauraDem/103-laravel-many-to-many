<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=> [
                "required",
                "string",
                Rule::unique("projects"),
            ],

            "content"=> ["required","string"],
            "type_id"=> [ "nullable", "exists:types,id"]
        ];
    }

    public function messages()
    {
        return [
            "name.required"=> "Il nome è obbligatorio",
            "name.string"=> "Il nome deve essere una stringa",
            


            "content.required"=> "Il contenuto è obbligatorio",
            "content.string"=> "Il contenuto deve essere una stringa",

            "type_id.exists"=> "Il tipo inserito non è valido"
        ];
}
}