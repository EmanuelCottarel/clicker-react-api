<?php

namespace App\Dto;

class UserDataDto {
    public function __construct(
        public string $username,
        public float $money, 
        public float $clicIncome, 
        public \DateTimeImmutable $lastConnection,
        public $userworkers,
        public $userupgrades,
        ){
    }
}
