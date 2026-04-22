<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',        
                'regex:/[0-9]/',        
                'regex:/[^A-Za-z0-9]/',   
            ],
        ];
    }

    public function messages(): array
{
    return [
        // name
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string',
        'name.max' => 'Name may not be greater than 255 characters',

        // email
        'email.required' => 'Email is required',
        'email.email' => 'Email format is invalid',
        'email.unique' => 'This email is already taken',

        // password
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters',
        'password.confirmed' => 'Password confirmation does not match',
        'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character',
    ];
}
}
