<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                        'nama_perusahaan' => ['required', 'max:255', 'unique:settings,nama_perusahaan,' . $this->route()->setting->id],
                        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'alamat' => 'required|string|max:255',
                        'phone' => 'required|string',
                        'email' => 'required|email|max:255',
                        'jam_buka' => 'nullable|string',
                        'footer_description' => 'required|string|max:255',
                        'tentang_perusahaan' => 'required|string|max:255',
                        'sejarah_perusahaan' => 'required|string',
                        'tentang_team' => 'nullable|string',
                        'hubungi_kami' => 'nullable|string',
                        'maps' => 'nullable|string',
                        'facebook' => 'nullable|url',
                        'instagram' => 'nullable|url',
                        'linkedin' => 'nullable|url',
                        'twitter' => 'nullable|url',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'nama_perusahaan' => 'required|string|max:255',
                        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'alamat' => 'required|string|max:255',
                        'phone' => 'required|string',
                        'email' => 'required|email|max:255',
                        'jam_buka' => 'nullable|string',
                        'footer_description' => 'required|string',
                        'tentang_perusahaan' => 'required|string',
                        'sejarah_perusahaan' => 'required|string',
                        'tentang_team' => 'nullable|string',
                        'hubungi_kami' => 'nullable|string',
                        'maps' => 'nullable|string',
                        'facebook' => 'nullable|url',
                        'instagram' => 'nullable|url',
                        'linkedin' => 'nullable|url',
                        'twitter' => 'nullable|url',
                    ];
                }
        }
    }
}