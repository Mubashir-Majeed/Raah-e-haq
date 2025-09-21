<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
            'cnic' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'country' => ['required', 'string', 'max:100'],
            'license_number' => ['nullable', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'in:car,motorcycle,bicycle'],
            'emergency_contact' => ['nullable', 'string', 'max:20'],
            'preferred_payment' => ['nullable', 'string', 'in:cash,card,wallet'],
        ];
    }
}
