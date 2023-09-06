<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\UserDataDto;
use App\Repository\UsersRepository;

class UserDataProvider implements ProviderInterface
{
    public function __construct(private UsersRepository $usersRepository) {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->usersRepository->find(1);
        $username = $user->getUserName();
        $money= $user->getMoney();
        $clicIncome = $user->getMoney();
        $lastConnection = $user->getLastConnection();
        
        return new UserDataDto(username : $username, money : $money, clicIncome : $clicIncome, lastConnection: $lastConnection);
    }
}
