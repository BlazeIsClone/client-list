<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StringArray implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return collect($value)->every(fn ($element) => is_string($element));
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return ':attribute can only be a string.';
    }
}
