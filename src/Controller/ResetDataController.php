<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;


class ResetDataController extends AbstractController
{
    public function __invoke( UserRepository $userRepository, Security $security) : User {
        $user = $security->getUser();
        $user = $userRepository->find($user);
        $user->setMoney(0)->setClicIncome(1)->setLastConnection(new \DateTimeImmutable());
        $userWorker = $user->getUserWorkers();
        foreach ($userWorker as $worker) {
            $user->removeUserWorker($worker);
        }
        $userUpgrade = $user->getUserUpgrades();
        foreach ($userUpgrade as $upgrade) {
            $user->removeUserUpgrade($upgrade);
        }
        $userRepository->save($user, true);

        return $user;
    }
}