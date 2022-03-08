<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Login
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @return mixed
     */
    public function __invoke($root, array $args): User
    {
        Log::info($args);
        if (!Auth::attempt($args)) {
            throw new Error('Invalid credentials');
        }

        return Auth::user();
    }
}
