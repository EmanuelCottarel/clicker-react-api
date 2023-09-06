<?php

namespace App\Dto;

class UserDataDto {
    public function __construct(public string $username,public string $age){
    }
}
