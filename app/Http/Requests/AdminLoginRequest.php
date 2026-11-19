<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $email = $this->input('email');
            $password = $this->input('password');
            $user = is_string($email) ? User::where('email', $email)->first() : null;

            if (! $user || ! Hash::check((string) $password, $user->password)) {
                $validator->errors()->add('email', 'The provided credentials are incorrect.');

                return;
            }

            if (! $user->hasRole('admin')) {
                $validator->errors()->add('email', 'This account does not have administrator access.');
            }
        });
    }
}
