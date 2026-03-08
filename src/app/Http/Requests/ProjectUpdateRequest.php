<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image' => 'sometimes|image|max:2048',
            'position' => 'sometimes|integer',
            'is_locked' => 'sometimes|boolean',
            'status' => 'sometimes|string|max:20',
            'development_days' => 'sometimes|string|max:255',
            'github_url' => 'sometimes|string|max:255',
            'demo_url' => 'sometimes|string|max:255',
        ];
    }
}
