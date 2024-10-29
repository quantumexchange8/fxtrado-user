<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required' =>  __('fullname_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'password.required' => __('password_required'),
            'password.confirmed' => __('password_confirmation_mismatch'),
            'password_confirmation.required' => __('password_confirmation_required'),
        ];
    }
}
