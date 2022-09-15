<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CreateUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'message' => ['sometimes', 'nullable', 'string'],
            'images' => ['array'],
            'images.*' => ['image'],
        ];
    }

    public function name(): string
    {
        return $this->get('name');
    }

    public function email(): string
    {
        return $this->get('email');
    }

    public function message(): string
    {
        return $this->get('message');
    }

    public function images(): Collection
    {
        return collect(Arr::get($this->allFiles(), 'images'));
    }
}
