<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|min:3|max:255'
        ];
    }

    public function massage()
    {
        return [
            'comment.required' => 'O comentário não pode ser vazio!',
            'comment.min' => 'O comentário deve conter no mínimo 3 caracteres!',
        ];
    }
}
