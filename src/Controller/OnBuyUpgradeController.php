<?php

namespace App\Controller;

use App\Repository\UpgradeRepository;
use App\Repository\UserRepository;
use App\Repository\UserWorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnBuyUpgradeController extends AbstractController
{
    public function __invoke(UpgradeRepository $upgradeRepository,
    UserRepository $userRepository,
    UserWorkerRepository $userWorkerRepository,
    EntityManagerInterface $manager,
    Security $security,
    Request $request)
    {

        $upgrade= $upgradeRepository->find($request->get('id'));
        $user = $security->getUser();
        $user = $userRepository->find($user);
        $user->addUpgrade($upgrade);
        $manager->persist($user);
        $manager->flush();
        $manager->clear();

        $effect=$upgrade->getIdEffect();
		$effectIndice = $effect->getIndice();
		$effectType = $effect->getIdEffectType()->getType();

        $affectWorker = $upgrade->getAffectWorker();
        // Supported worker type : ['clic', 'idle']
        // Supported effect type : ['*', '+'] (to handle / use  *, example x/2 = x*0.5)
        if ($effectType === "+") {
            foreach ($affectWorker as $affectedWorker) {
                if ($affectedWorker->getIdWorkerType()->getType() === 'clic') {
                    $user->setClicIncome($user->getClicIncome()+$effectIndice);
                    $manager->persist($user);
                }else if ($affectedWorker->getIdWorkerType()->getType() === 'worker') {
                    $userWorker = $userWorkerRepository->find($affectedWorker);
                    $userWorker->setCalculatedIncome($userWorker->getCalculatedIncome()+$effectIndice);
                    $manager->persist($userWorker);
                }
                $manager->flush();
                $manager->clear();
            }  
        }else if ($effectType === "*") {
            foreach ($affectWorker as $affectedWorker) {
                if ($affectedWorker->getIdWorkerType()->getType() === 'clic') {
                    $user->setClicIncome($user->getClicIncome()*$effectIndice);
                    $manager->persist($user);
                }else if ($affectedWorker->getIdWorkerType()->getType() === 'worker') {
                    $userWorker = $userWorkerRepository->findOneBy(['idWorker'=>$affectedWorker]);
                    $userWorker->setCalculatedIncome($userWorker->getCalculatedIncome()*$effectIndice);
                    $manager->persist($userWorker);
                }
                $manager->flush();
                $manager->clear();
            }  
        }
    }
}
