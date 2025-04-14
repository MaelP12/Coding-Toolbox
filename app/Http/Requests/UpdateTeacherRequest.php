<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
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
        $teacher = $this->route('teacher');

        return [
            'last_name' => ['string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'first_name' => ['string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($teacher->id),],
            'birth_date' => ['date','after_or_equal:2000-01-01','before_or_equal:2025-12-31'],
            'school_id' => ['required'],
        ];
    }
}
