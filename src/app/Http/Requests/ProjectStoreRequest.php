<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'position' => 'required|integer',
            'is_locked' => 'required|boolean',
            'status' => 'required|string|max:20',
            'development_days' => 'required|string|max:255',
            'github_url' => 'required|string|max:255',
            'demo_url' => 'required|string|max:255',
        ];
    }
}
