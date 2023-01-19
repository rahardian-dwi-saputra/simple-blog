<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug',
            'category' => 'required|exists:categories,id',
            'tanggal_posting' => 'required|date_format:d-m-Y|before:tomorrow',
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
    public function attributes(){
        return [
            'title' => 'Judul',
            'category' => 'Kategori',
            'tanggal_posting' => 'Tanggal posting',
            'body' => 'Isi'
        ];
    }
}
