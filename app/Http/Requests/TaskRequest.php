<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // The ID must exist in the categories table
            'due_date' => 'required|date|after_or_equal:today',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
{
    return [
        // title
        'title.required' => 'Title is required.',
        'title.string' => 'Title must be a string.',
        'title.max' => 'Title may not be greater than 255 characters.',

        // category_id
        'category_id.required' => 'Category is required.',
        'category_id.exists' => 'The selected category is invalid.',

        // due_date
        'due_date.required' => 'Due date is required.',
        'due_date.date' => 'Due date must be a valid date.',
        'due_date.after_or_equal' => 'Due date must be today or a future date.',

        // description
        'description.string' => 'Description must be a string.',
    ];
}
}
