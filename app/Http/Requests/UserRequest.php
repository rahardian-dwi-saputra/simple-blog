<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username|min:3|alpha_dash'
        ];

        if (request()->is('register') || request()->routeIs('user.store')){
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['password'] = 'required|min:5|confirmed';
        }

        if(request()->routeIs('user.store')){
            $rules['role'] = 'required|boolean';
        }

        if(request()->routeIs('user.update')){
            $rules['username'] = [
                'required',
                'min:3',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($this->user)
            ];
            $rules['role'] = 'required|boolean';
        }

        return $rules;
    }
}
