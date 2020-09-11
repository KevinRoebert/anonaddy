<?php

namespace App\Rules;

use App\DeletedUsername;
use Illuminate\Contracts\Validation\Rule;

class NotDeletedUsername implements Rule
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
        $deletedUsernames = DeletedUsername::all()
            ->map(function ($item) {
                return $item->username;
            })
            ->toArray();

        return !in_array(strtolower($value), $deletedUsernames);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
