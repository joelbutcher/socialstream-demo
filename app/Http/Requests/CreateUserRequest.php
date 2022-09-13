<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function firstName(): string
    {
        return $this->get('first_name');
    }

    public function lastName(): string
    {
        return $this->get('last_name');
    }

    public function email(): string
    {
        return $this->get('email');
    }

    public function password(): string
    {
        return $this->get('password');
    }
}
