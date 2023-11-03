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
            'name'=> [
                'required',
                'string',
                Rule::unique('projects')->ignore($this->project->id),
            ],
            'cover_image' => ['nullable', 'image', 'max:900' ],


            'content'=> ['required','string'],
            'type_id' => [ 'nullable', 'exists:types,id'],
            'technologies' => ['nullable','exists:technologies,id'],
            ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Il nome è obbligatorio',
            'name.string'=> 'Il nome deve essere una stringa',
            

            
            'cover_image.image'=> 'Il file caricato deve essere un\'immagine',
            'cover_image.max'=> 'L\'immagine deve essere massimo 900KB',



            'content.required'=> 'Il contenuto è obbligatorio',
            'content.string'=> 'Il contenuto deve essere una stringa',

            'type_id.exists'=> 'Il tipo inserito non è valido',
            'technologies.exists' => 'La tec inserita non è valida',
        ];
}
}