<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Repository\ZipCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ZipCodeValidator extends ConstraintValidator
{
    /**
     * @var ZipCodeRepository
     */
    private $zipCodeRepository;

    public function __construct(ZipCodeRepository $zipCodeRepository)
    {
        $this->zipCodeRepository = $zipCodeRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!in_array($value, $this->zipCodeRepository->getAll())) {
            $this->context->addViolation($constraint->message);
            $this->context->buildViolation($constraint->message)
                          ->atPath('zipCode')
                          ->addViolation();
        }
    }
}
