<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'animal_status_id' => ['required', 'exists:animal_statuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'in:dog,cat'],
            'sex' => ['required', 'in:male,female'],
            'age' => ['nullable', 'string', 'max:100'],
            'size' => ['nullable', 'string', 'max:100'],
            'weight' => ['nullable', 'string', 'max:100'],
            'breed' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'rescue_date' => ['nullable', 'date'],
            'rescue_location' => ['nullable', 'string', 'max:255'],
            'story' => ['nullable', 'string'],
            'sterilized' => ['boolean'],
            'vaccinated' => ['boolean'],
            'dewormed' => ['boolean'],
            'microchipped' => ['boolean'],
            'medical_conditions' => ['nullable', 'string'],
            'disabilities' => ['nullable', 'string'],
            'medications' => ['nullable', 'string'],
            'medical_observations' => ['nullable', 'string'],
            'available_for_adoption' => ['boolean'],
            'available_for_sponsorship' => ['boolean'],
            'adopted' => ['boolean'],
            'in_recovery' => ['boolean'],
            'deceased' => ['boolean'],
            'lost' => ['boolean'],
            'personality' => ['nullable', 'string'],
            'lives_with_dogs' => ['boolean'],
            'lives_with_cats' => ['boolean'],
            'lives_with_children' => ['boolean'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }
}
