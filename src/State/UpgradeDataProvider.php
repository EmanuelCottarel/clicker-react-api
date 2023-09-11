<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\UpgradeDataDto;
use App\Repository\UpgradeRepository;

class UpgradeDataProvider implements ProviderInterface
{
	public function __construct(private UpgradeRepository $upgradeRepository) {
	}
	public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
	{
		$upgrade= $this->upgradeRepository->find($uriVariables['id']);
		$upgradeName = $upgrade->getUpgradeName();
		$price=$upgrade->getPrice();
		$upgradeDesc=$upgrade->getUpgradeDesc();
		$effect=$upgrade->getIdEffect();
		$effectIndice = $effect->getIndice();
		$effectName = $effect->getName();
		$effectType = $effect->getIdEffectType()->getType();
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