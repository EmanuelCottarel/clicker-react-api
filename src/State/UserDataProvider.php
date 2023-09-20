<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\UserDataDto;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

class UserDataProvider implements ProviderInterface
{
    public function __construct(private UserRepository $userRepository, private Security $security,)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();
        $user = $this->userRepository->find($user);
        $username = $user->getUserName();
        $money = $user->getMoney();
        $clicIncome = $user->getClicIncome();
        $lastConnection = $user->getLastConnection();
        $userupgrades = $user->getUpgrades();

        $userworkers = $user->getUserWorkers();
        $formattedUserWorker = [];
        foreach ($userworkers as $userworker) {
            $formattedUserWorker[] = [
                "id" => $userworker->getId(),
                "name" => $userworker->getWorker()->getName(),
                "quantity" => $userworker->getQuantity(),
                "calculatedIncome" => $userworker->getCalculatedIncome()
            ];
        }

        return new UserDataDto(
            id: $user->getId(),
            username: $username,
            money: $money,
            clicIncome: $clicIncome,
            lastConnection: $lastConnection,
            userWorkers: $formattedUserWorker
        );
    }
}
