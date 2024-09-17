<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->routeIs('post.update')){
            return $this->user()->can('access-post', $this->post);
        }else
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug|max:255',
            'category' => 'required|exists:categories,slug',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        if(request()->routeIs('post.update')){
            $rules['slug'] = [
                'required',
                Rule::unique('posts', 'slug')->ignore($this->post)
            ];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul',
            'category' => 'Kategori',
            'tanggal_posting' => 'Tanggal posting',
            'body' => 'Isi'
        ];
    }
}
