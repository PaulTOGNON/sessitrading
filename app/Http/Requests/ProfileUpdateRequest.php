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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        if ($this->has('first_name') || $this->has('last_name')) {
            $rules['first_name'] = ['required', 'string', 'max:255'];
            $rules['last_name'] = ['required', 'string', 'max:255'];
            $rules['phone_number'] = ['required', 'string', 'max:50'];
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['city'] = ['required', 'string', 'max:255'];
            $rules['country'] = ['required', 'string', 'max:255'];
        } else {
            $rules['name'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }
}
