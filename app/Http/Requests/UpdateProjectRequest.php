<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
                "unique:projects,id",
                Rule::unique("projects")->ignore($this->project_id),
            ],

            "content"=> ["required","string"],
        ];
    }

    public function messages()
    {
        return [
            "name.required"=> "Il nome è obbligatorio",
            "name.string"=> "Il nome deve essere una stringa",
            "name.unique"=> "Esiste già un progetto con questo nome",


            "content.required"=> "Il contenuto è obbligatorio",
            "content.string"=> "Il contenuto deve essere una stringa",
        ];
}
}