<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {   
        $cpf = $value;

        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            $fail('The field :attribute is not valid cpf.');
        }

        // Verifica se todos os dígitos são iguais, o que é inválido
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('The field :attribute is not valid cpf.');
        }

        // Divide o CPF em duas partes (nove primeiros dígitos e dois dígitos verificadores)
        $primeiros_nove = substr($cpf, 0, 9);
        $digitos_verificadores = substr($cpf, 9);

        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $primeiros_nove[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito_verificador1 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica se o primeiro dígito verificador calculado é igual ao primeiro dígito verificador real
        if ($digito_verificador1 != $digitos_verificadores[0]) {
            $fail('The field :attribute is not valid cpf.');
        }

        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $primeiros_nove[$i] * (11 - $i);
        }
        $soma += $digito_verificador1 * 2;
        $resto = $soma % 11;
        $digito_verificador2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica se o segundo dígito verificador calculado é igual ao segundo dígito verificador real
        if ($digito_verificador2 != $digitos_verificadores[1]) {
            $fail('The field :attribute is not valid cpf.');
        }
    }
}
