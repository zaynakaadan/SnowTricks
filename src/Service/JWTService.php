<?php 

namespace App\Service;

class JWTService
{
    //Génère le token

    public function generate(array $header, array $payload, string $secret, int $validity = 10800): string
    {
        if($validity <= 0){
            return "";
        }
        return $jwt;
    }
}