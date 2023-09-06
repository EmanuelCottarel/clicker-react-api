<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\UserDataDto;

class UserDataProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $username = "Jean";
        $age = "Jean";
        // Retrieve the state from somewhere
        return new UserDataDto(username : $username, age : $age);
    }
}
