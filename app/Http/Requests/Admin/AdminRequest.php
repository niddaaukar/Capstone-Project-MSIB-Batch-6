<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'avatar' => 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096',
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:8',
                        'is_admin' => 'required|boolean',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'avatar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
                        'name' => ['required', 'max:255', 'unique:users,name,' . $this->route()->user->id],
                        'email' => 'required|string|email|max:255|unique:users',
                        // 'password' => 'required|string|min:8',
                    ];
                }
        }
    }
}
