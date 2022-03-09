<?php

namespace App\GraphQL\Mutations\User;

use App\GraphQL\Mutations\Mutation;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpdateUser extends Mutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        // 
    }
}
