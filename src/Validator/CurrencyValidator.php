<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;



class CurrencyValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var Currency $constraint */
        $validator = Validation::createValidator();

        // if (null === $value || '' === $value) {
        //     return;
        // }

        // // TODO: implement the validation here
        // $this->context->buildViolation($constraint->message)
        //     ->setParameter('{{ value }}', $value)
        //     ->addViolation();

        $constraint = new Assert\Collection([
            "name"=>[new Assert\NotBlank(),new Assert\NotNull()],
            "symbol"=>[new Assert\NotBlank(),new Assert\NotNull()],
        ]);

        $violations = $validator->validate($value, $constraint);
    }
}
