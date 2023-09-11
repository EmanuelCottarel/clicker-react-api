<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\UpgradeRepository;
use App\Repository\UserRepository;
use App\Repository\UserWorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class OnUpgradeBuyProcessor implements ProcessorInterface
{
    public function __construct(
        private UpgradeRepository $upgradeRepository,
        private UserRepository $userRepository,
        private UserWorkerRepository $userWorkerRepository,
        private EntityManagerInterface $manager,
        private Security $security
        ){
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        dd($uriVariables);
        $upgrade= $this->upgradeRepository->find($uriVariables['id']);
        $user = $this->security->getUser();
        $user = $this->userRepository->find($user);
        $user->addUpgrade($upgrade);
        $this->manager->persist($user);
        $this->manager->flush();
        $this->manager->clear();

        $effect=$upgrade->getIdEffect();
		$effectIndice = $effect->getIndice();
		$effectType = $effect->getIdEffectType()->getType();

        $affectWorker = $upgrade->getAffectWorker()->toArray();
        // dd($affectWorker);
        // Supported worker type : ['clic', 'idle']
        // Supported effect type : ['*', '+'] (to handle / use  *, example x/2 = x*0.5)
        if ($effectType === "+") {
            foreach ($affectWorker as $affectedWorker) {
                if ($affectedWorker->getIdWorkerType()->getType() === 'clic') {
                    $user->setClicIncome($user->getClicIncome()+$effectIndice);
                    $this->manager->persist($user);
                }else if ($affectedWorker->getIdWorkerType()->getType() === 'worker') {
                    $userWorker = $this->userWorkerRepository->find($affectedWorker);
                    $userWorker->setCalculatedIncome($userWorker->getCalculatedIncome()+$effectIndice);
                    $this->manager->persist($userWorker);
                }
                // $this->manager->flush();
                // $this->manager->clear();
            }  
        }else if ($effectType === "*") {
            foreach ($affectWorker as $affectedWorker) {
                if ($affectedWorker->getIdWorkerType()->getType() === 'clic') {
                    $user->setClicIncome($user->getClicIncome()*$effectIndice);
                    $this->manager->persist($user);
                }else if ($affectedWorker->getIdWorkerType()->getType() === 'worker') {
                    $userWorker = $this->userWorkerRepository->find($affectedWorker);
                    $userWorker->setCalculatedIncome($userWorker->getCalculatedIncome()*$effectIndice);
                    $this->manager->persist($userWorker);
                }
                $this->manager->flush();
                $this->manager->clear();
            }  
        }
    }
}
