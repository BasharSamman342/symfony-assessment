<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;


class CountryRequest 
{
    public function __construct(
        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly string $name,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly string $region,

        #[Assert\NotBlank(allowNull:true)]
        public readonly ?string $subRegion,

        #[Assert\Type('number')]
        #[Assert\Positive()]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly int $population,

        #[Assert\Type('bool')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly bool $independent,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly string $flag,

        #[Assert\Type('string')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        public readonly string $demonym,

        #[Assert\Type('array')]
        #[Assert\NotBlank()]
        #[Assert\NotNull()]
        #[AcmeAssert\CurrencyValidator()]
        public readonly array $currency,
    ){}
}