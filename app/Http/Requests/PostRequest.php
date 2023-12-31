<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /****************************************************
     * バリデーションのルール
     *
     * @return array
     ****************************************************/
    public function rules(){
        return [
            'title' => 'required|min:3',
            'body' => 'required',
        ];
    }
    /****************************************************
     * エラーメッセージのカスタマイズの設定
     *
     * @return array
     ****************************************************/
    public function messages(){
        return [
            'title.required' => 'タイトルは必須です',
            'title.min' => ':min 文字以上入力してください',
            'body.required' => '本文は必須です',
        ];
    }
}
