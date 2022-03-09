<?php

namespace App\GraphQL\Mutations\User;

use App\GraphQL\Mutations\Mutation;
use App\UseCases\Auth\RegisterUserUseCase;
use Error;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateUser extends Mutation
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisteruserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase  = $registerUserUseCase;
    }

    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $result = $this->registerUserUseCase->execute($args);
        if ($result['is_fail']) {
            throw new Error($result['message']);
        }

        $access_token = $result['data']['access_token'];
        $refresh_token = $result['data']['refresh_token'];
        $user = $result['data']['user'];

        return [
            'name' => $user->name,
            'email' => $user->email,
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
        ];
    }
}
