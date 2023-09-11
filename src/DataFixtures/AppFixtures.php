<?php

namespace App\DataFixtures;

use App\Entity\Effect;
use App\Entity\EffectType;
use App\Entity\Upgrade;
use App\Entity\User;
use App\Entity\UserWorker;
use App\Entity\Worker;
use App\Entity\WorkerType;
use App\Repository\EffectRepository;
use App\Repository\EffectTypeRepository;
use App\Repository\UserRepository;
use App\Repository\WorkerRepository;
use App\Repository\WorkerTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
	public function __construct(
		private readonly WorkerTypeRepository $workerTypeRepository,
		private readonly UserRepository $userRepository,
		private readonly WorkerRepository $workerRepository,
		private readonly EffectRepository $effectRepository,
		private readonly EffectTypeRepository $effectTypeRepository,
	){}

	public function load(ObjectManager $manager): void
	{
		$this->loadUsers($manager);
		$this->loadWorkers($manager);
		$this->loadUserWorkers($manager);
		$this->loadEffects($manager);
		$this->loadUpgrades($manager);
	}

	private function loadUsers(ObjectManager $manager)
	{
		$admin = new User();
		// Password = admin
		$admin->setUsername("admin")->setPassword('$2y$13$LXGYRqV/oH0.Mr5LPy4rDOiKEdwUtaaFBtaIZnCcSZatgkpQE3AH.');
		$manager->persist($admin);

		$manager->flush();
		$manager->clear();
	}

	private function loadWorkers(ObjectManager $manager)
	{
		$workerType = new WorkerType();
		$workerType->setType("clic");
		$manager->persist($workerType);
		
		$workerType = new WorkerType();
		$workerType->setType('worker');
		
		$manager->persist($workerType);
		$manager->flush();
		$manager->clear();

		$worker = new Worker();
		$worker->setBaseIncome(1)->setBasePrice(50)->setName("Carapuce")->setIdWorkerType($this->workerTypeRepository->findOneBy(['type'=>'worker']));
		$manager->persist($worker);

		$worker = new Worker();
		$worker->setBaseIncome(0.5)->setBasePrice(25)->setName("Salameche")->setIdWorkerType($this->workerTypeRepository->findOneBy(['type'=>'worker']));
		$manager->persist($worker);

		$manager->flush();
		$manager->clear();
	}

	private function loadUserWorkers(ObjectManager $manager)
	{
		$userWorker = new UserWorker();
		$userWorker->setCalculatedIncome(0.5)->setQuantity(4)->setIdUser($this->userRepository->findOneBy(["username" => "admin"]))->setIdWorker($this->workerRepository->findOneBy(["name" => "Salameche"]));
		$manager->persist($userWorker);

		$manager->flush();
		$manager->clear();
	}

	private function loadEffects(ObjectManager $manager)
	{
		$effectType = new EffectType();
		$effectType->setType('+');
		$manager->persist($effectType);

		$effectType = new EffectType();
		$effectType->setType('*');
		$manager->persist($effectType);

		$manager->flush();
		$manager->clear();

		$effect = new Effect();
		$effect->setIndice(2)->setName('multiplie par 2')->setIdEffectType($this->effectTypeRepository->findOneBy(['type' => '*']));
		$manager->persist($effect);

		$manager->flush();
		$manager->clear();
	}

	private function loadUpgrades(ObjectManager $manager)
    {
        $upgrade = new Upgrade();
		$upgrade->addAffectWorker($this->workerRepository->findOneBy(["name" => "Salameche"]))->setPrice(1000)->setUpgradeName('Poffins a la baie Kiwan')->setUpgradeDesc('Ces poffins épicés revigorent vos Salameches et multiplient leur rendement par 2')->setIdEffect($this->effectRepository->findOneBy(['name'=>'multiplie par 2']));
        $manager->persist($upgrade);

        $manager->flush();
        $manager->clear();
    }
	
}
