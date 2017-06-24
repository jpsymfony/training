<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Repository\ZipCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

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
        if (!$constraint instanceof ZipCode) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\ZipCode');
        }

        if (!preg_match("/^(([0-8][0-9])|(9[0-5]))[0-9]{3}/", $value) || !in_array($value, $this->zipCodeRepository->getAllZipCodes())) {
            $this->context->addViolation($constraint->message);
            //$this->context->buildViolation($constraint->message)
            //              ->atPath('zipCode')
            //              ->addViolation();
        }
    }
}
