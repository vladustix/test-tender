<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenderRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'number' => 'required|regex:/^([a-zA-Z0-9-.,]*)$/',
            'status' => 'required|in:Открыто,Закрыто,Отменено',
            'name' => 'required|max:255'
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'code' => 'exists:tenders,code'
                ] + $rules;
            case 'DELETE':
                return [
                    'code' => 'exists:tenders,code'
                ];
        }
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number.required' => 'Обязательно заполните номер',
            'number.regex' => 'Номер должен содержать только латинские буквы, цифры, точку и запятую.',
            'status.required' => 'Обязательно выберите статус',
            'status.in' => 'Выберите один из статусов: Открыто, Закрыто, Отменено',
            'name.required' => 'Обязательно заполните номер',
            'name.max' => 'Длина названия должна быть не более 255'
        ];
    }
}
