<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;


class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Common fields for all users
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'phone' => ['required', 'string', 'max:20'],
            'governorate' => ['required_if:role,regular', 'string', 'max:255'],


            // Conditional fields for exchange role
            'shop_name' => ['required_if:role,exchange', 'string', 'max:255'],
            'crypto_supported' => ['nullable', 'boolean'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'shop_name.required_if' => 'The shop name is required when registering as an exchange.',
            'role.in' => 'The role must be either regular or exchange.',
        ];
    }


    public function withValidator($validator)
    {
        if ($this->role === 'regular'){
            $validator->after(function ($validator) {
                $value = $this->input('governorate');

                $existsInAr = \DB::table('governorates')->where('name_ar', $value)->exists();
                $existsInEn = \DB::table('governorates')->where('name_en', $value)->exists();

                if (! $existsInAr && ! $existsInEn) {
                    $validator->errors()->add('governorate', 'The governorate is not a valid governorate.');
                }
            });
        }

    }
}


