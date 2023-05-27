<?php

namespace App\Rules;

use App\Models\Answer;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserHasAnswer implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper(Answer::find($value)->user->id !== auth()->id())) {
            $fail('Seu usuário não possui permissão para deletar esta resposta');
        }
    }
}
