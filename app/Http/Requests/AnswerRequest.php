<?php

namespace App\Http\Requests;

use App\Rules\UserHasAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class AnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
                        'topic' => 'exists:App\Models\Topic,id|integer|required',
                        'content' => 'required'
                    ];
                }
            case 'DELETE': {
                    return [
                        'answer' => ['required', 'integer', 'exists:answers,id', new UserHasAnswer]
                    ];
                }
            default:
                break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'topic.exists' => 'Houve um erro ao postar sua resposta, tente novamente!',
            'content.required' => 'Preencha o campo de resposta!',
        ];
    }
}
