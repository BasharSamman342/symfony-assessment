<?php

namespace App\Requests;

use App\Validator\Currency;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CountryRequest extends BaseRequest
{
    #[Type('string')]
    #[NotBlank()]
    #[NotNull()]
    protected $name;

    #[Type('string')]
    #[NotBlank()]
    #[NotNull()]
    protected $region;

    #[Type('string')]
    #[Blank()]
    protected $subRegion;

    #[Type('number')]
    #[NotBlank()]
    #[NotNull()]
    protected $population;

    #[Type('string')]
    #[NotBlank()]
    #[NotNull()]
    protected $flag;

    #[Type('string')]
    #[NotBlank()]
    #[NotNull()]
    protected $demonym;

    #[Type('array')]
    #[NotBlank()]
    #[NotNull()]
    #[Currency()]
    protected $currency;
}