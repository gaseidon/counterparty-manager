<?php
namespace App\DTO;

use Spatie\LaravelData\Data;

class CounterpartyData extends Data
{
    public function __construct(
        public string $inn,
        public string $name,
        public string $ogrn,
        public string $address
    ) {}
}