<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:40|unique:projects,title',
            'description' => 'string|nullable',
            'languages' => 'required|max:60',
            'frameworks' => 'required|max:40',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titolo del progetto richiesto',
            'title.max' => 'Numero massimo caratteri: :max',
            'title.unique' => 'Il titolo è già presente nel db',
            'description.string' => 'La descrizione deve essere una stringa',
            'languages.required' => 'Linguaggi utilizzati richiesti',
            'languages.max' => 'Numero massimo caratteri: :max',
            'frameworks.required' => 'Frameworks utilizzati richiesti',
            'frameworks.max' => 'Numero massimo caratteri: :max',
            'type_id.exists' => "L'id del tipo selezionato non è valido",
            'technologies.exists' => "L'id della tecnologia selezionata non è valido",
        ];
    }
}
