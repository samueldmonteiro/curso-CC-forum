<?php

namespace App\Http\Requests;

use App\Rules\User\Avatar;
use App\Rules\User\Period;
use App\Rules\User\Shift;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /* Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->method() == 'PUT') {
            return auth()->check();
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        /**
        if (!in_array($request->period, [1, 2, 3, 4, 5])) {
            return back()->withErrors(['period' => 'Preecha o campo de período corretamente']);
        }

        if (!in_array($request->shift, ['Matutino', 'Vespertino', 'Noturno'])) {
            return back()->withErrors(['period' => 'Preecha o campo de turno corretamente']);
        }
         **/
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required|min:5|max:30',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|min:8|max:40',
                        'confirm_password' => 'required|min:8|same:password'
                    ];
                }
            case 'PUT': {
                    return [
                        'avatar' => [new Avatar, 'nullable', 'image', 'mimes:jpg,jpeg,png'],
                        'name' => 'required|min:5|max:30',
                        //'email' => 'email|required|unique:users',
                        'period' => ['required', 'integer', new Period],
                        'shift' => ['required', new Shift],
                        'password' => 'nullable|min:8|max:40',
                        'confirm_password' => 'nullable|min:8|same:password'
                    ];
                }
            default:
                # code...
                break;
        }
    }
}
