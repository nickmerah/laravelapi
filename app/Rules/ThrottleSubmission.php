<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class ThrottleSubmission implements Rule
{
    protected $user;
   
    public function __construct(User $user)
    {
        $this->user = $user;
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
        return $this->user->latestMessage != null ? $this->user->latestMessage->created_at->lt(
            now()->subMinutes(1)
        ): null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplicate Submission spotted, Try submitting after some time.';
    }
}
