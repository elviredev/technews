<?php

namespace App\Http\Requests\Settings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'web_site_name' => ['required', 'string', 'max:100'],
          'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
          'address' => ['nullable', 'string', 'max:255'],
          'phone' => ['nullable', 'string', 'max:100'],
          'email' => ['nullable', 'string', 'max:100'],
          'about' => ['required', 'string'],
        ];
    }
}
