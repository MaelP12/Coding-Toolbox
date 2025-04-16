<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $student = $this->route('student');

        return [
            'last_name' => ['string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'first_name' => ['string', 'max:255', 'regex:/^[A-Za-z-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->id),],
            'birth_date' => ['date','after_or_equal:2000-01-01','before_or_equal:2025-12-31'],
            'school_id' => ['required'],
        ];
    }

    public function getErrorBag()
    {
        return 'update';
    }

}
