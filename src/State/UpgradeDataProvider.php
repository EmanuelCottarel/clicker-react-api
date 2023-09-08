<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\UpgradeDataDto;
use App\Dto\UserDataDto;
use App\Repository\EffectRepository;
use App\Repository\EffectTypeRepository;
use App\Repository\UpgradeRepository;
use App\Repository\UserRepository;
use App\Repository\WorkerRepository;
use Symfony\Bundle\SecurityBundle\Security;

class UpgradeDataProvider implements ProviderInterface
{
	public function __construct(private WorkerRepository $workerRepository, private UpgradeRepository $upgradeRepository, private EffectRepository $effectRepository, private EffectTypeRepository $effectTypeRepository) {
	}
	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
	{
		$upgrade= $this->upgradeRepository->find($uriVariables['id']);
		$upgradeName = $upgrade->getUpgradeName();
		$price=$upgrade->getPrice();
		$upgradeDesc=$upgrade->getUpgradeDesc();
		$effect=$this->effectRepository->find($upgrade->getIdEffect()->getId());
		$effectIndice = $effect->getIndice();
		$effectName = $effect->getName();
		$effectType = $this->effectTypeRepository->find($effect->getIdEffectType()->getId())->getType();
		$affectWorker = $upgrade->getAffectWorker();
		
		return new UpgradeDataDto(
			upgradeName : $upgradeName,
			price : $price,
			upgradeDesc : $upgradeDesc,
			effectIndice : $effectIndice,
			effectName : $effectName,
			effectType : $effectType,
			affectWorker : $affectWorker
		);
	}
}