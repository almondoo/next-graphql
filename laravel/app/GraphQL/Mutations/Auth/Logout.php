<?php

namespace App\GraphQL\Mutations\Auth;

use App\GraphQL\Mutations\Mutation;
use Error;
use App\UseCases\Auth\LogoutUserUseCase;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Logout extends Mutation
{
    /**
     * ログアウト
     */
    private LogoutUserUseCase $logoutUserUseCase;

    public function __construct(LogoutUserUseCase $logoutUserUseCase)
    {
        $this->logoutUserUseCase = $logoutUserUseCase;
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
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): bool
    {
        $result = $this->logoutUserUseCase->execute();
        if ($result['is_fail']) {
            throw new Error($result['message']);
        }

        return true;
    }
}
