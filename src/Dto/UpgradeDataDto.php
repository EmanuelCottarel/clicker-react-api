<?php

namespace App\Dto;

class UpgradeDataDto {
    public function __construct(
        public string $upgradeName,
        public int $price,
        public string $upgradeDesc,
        public string $effectName,
        public string $effectType,
        public int $effectIndice,
        public $affectWorker
        ){
    }
}
