<?php

namespace App\Dto;

class UserWorkerPatchDto {
    public function __construct(
        public ?int $quantity,
        public ?int $calculatedIncome,
        public \DateTimeImmutable $lastConnection
    ){
    }
}
