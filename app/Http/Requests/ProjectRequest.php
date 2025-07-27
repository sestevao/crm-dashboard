<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Implement authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'start_date' => 'required|date|after_or_equal:today',
            'deadline' => 'required|date|after:start_date',
            'status' => 'required|string|in:planning,active,on_hold,completed,cancelled',
            'manager_id' => 'required|exists:users,id',
            'budget' => 'nullable|numeric|min:0|max:999999999.99',
            'progress' => 'required|integer|min:0|max:100',
            'team_members' => 'required|array|min:1',
            'team_members.*' => 'exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Project name is required.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'deadline.after' => 'Deadline must be after the start date.',
            'manager_id.exists' => 'Selected manager does not exist.',
            'team_members.required' => 'At least one team member must be assigned.',
            'team_members.*.exists' => 'One or more selected team members do not exist.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'manager_id' => 'project manager',
            'team_members' => 'team members',
        ];
    }
}
