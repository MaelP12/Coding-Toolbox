<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birth_date' => ['required','date','after_or_equal:2000-01-01','before_or_equal:2025-12-31'],
            'school_id' => ['required'],
        ];
    }

    public function getErrorBag()
    {
        return 'create';
    }

}
