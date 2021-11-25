<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DomainRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $blacklist= [
            'rcpt.at',
            'damnthespam.at',
            'wegwerfmail.de',
            'trashmail.de',
            'trashmail.com'
        ];

        $parts =explode('@', $value);
        $domain = array_pop($parts);

        if(in_array($domain, $blacklist)){
            return false;
        }
        return true;

        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email should not contain any invalid Domains.';
    }
}
