<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id'
        ];
    }
    //Кастомные ошибки
    public function messages()
    {
        return [
            'title.required' => 'Это обязательное поле',
            'title.string' => 'Неверный тип данных, ожидаем строку',
            'preview_image.required' => 'Это обязательное поле',
            'preview_image.file' => 'Неверный тип данных, ожидаем файл',
            'main_image.required' => 'Это обязательное поле',
            'main_image.file' => 'Неверный тип данных, ожидаем файл',
            'category_id.required' => 'Обязательное поле',
            'category_id.exists' => 'Id категории должен быть в базе',
            'tag_ids.exists' => 'Необходимо отправить массив id',
        ];
    }
}
