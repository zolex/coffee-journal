<?php

namespace App\Validator\Constraint;

use App\Entity\CoffeeBean;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CoffeeBeansValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        $beanIds = [];
        $percent = 0;

        /** @var CoffeeBean $coffeeBean */
        foreach ($value as $coffeeBean) {
            $beanId = $coffeeBean->getType()->getId();
            if (in_array($beanId, $beanIds)) {
                $this->context->buildViolation("Each bean type must only appear once for a coffee.")->addViolation();
            }
            $beanIds[] = $beanId;
            $percent += $coffeeBean->getPercent();
        }

        if ($percent !== 100) {
            $this->context->buildViolation("The coffee beans must sum up to 100%")->addViolation();
        }
    }
}
