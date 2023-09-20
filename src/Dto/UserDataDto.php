<?php

namespace App\Dto;

class UserDataDto {
    public function __construct(
        public float $id,
        public string $username,
        public float $money, 
        public float $clicIncome, 
        public \DateTimeImmutable $lastConnection,
        public array $userWorkers,
        ){
    }
}
