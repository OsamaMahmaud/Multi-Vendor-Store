<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $forbidden;

     public function __construct($forbidden)
     {
        $this->forbidden =$forbidden;
     }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {


         if (!is_array(strtolower($value))== $this->forbidden) {
            $fail('The :attribute is not allawed !');
            }
    }
}
