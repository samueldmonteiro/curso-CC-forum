<?php

namespace App\Rules\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Avatar implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array(pathinfo($value->getClientOriginalName())['extension'], ['png', 'jpg', 'jpeg'])) {
            $fail('Formato de arquivo inválido, envia um Imagem!');
        }
    }
}
