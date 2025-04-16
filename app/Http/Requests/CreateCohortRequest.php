<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCohortRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[-A-Za-z0-9\s]+$/'],
            'description' => ['required', 'string', 'regex:/^[A-Za-zÀ-ÿ0-9.,;:!?()\[\]\'" \n-]{10,500}$/'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
            'school_id' => ['required'],
            'address' => ['required','string','regex:/^[-A-Za-z\s]+$/'],
        ];
    }
}
