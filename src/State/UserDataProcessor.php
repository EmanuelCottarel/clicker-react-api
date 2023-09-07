<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class UserDataProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $user = $this->security->getUser();
        $user = $this->userRepository->find($user);
        $username = $user->getUserName();
        $money= $user->getMoney();
        $clicIncome = $user->getMoney();
        $lastConnection = $user->getLastConnection();
        $userworkers = $user->getUserWorkers();
        $userupgrades = $user->getUserUpgrades();
    }
}
