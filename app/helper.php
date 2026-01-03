<?php

use App\Models\User;

if (! function_exists('auth_user')) {
    /**
     * Get the authenticated user based on the specified guard.
     *
     * @param  string|null  $guard  The name of the guard. Defaults to 'web' if null.
     * @return User|null The authenticated user or null if the guard is invalid.
     */
    function auth_user(?string $guard = null): User
    {
        return auth($guard)->user();
    }
}
