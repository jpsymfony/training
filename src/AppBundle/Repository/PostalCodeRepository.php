<?php

namespace AppBundle\Repository;

class PostalCodeRepository extends \Doctrine\ORM\EntityRepository implements PostalCodeRepositoryInterface
{
    /**
     * @param $postalCode
     *
     * @return array
     */
    public function getByPostalCode($postalCode)
    {
        return $this
            ->createQueryBuilder('pc')
            ->select('pc.code')
            ->where('pc.code LIKE :postalCode')
            ->setParameter('postalCode', '%' . $postalCode . '%')
            ->getQuery()
            ->getScalarResult();
    }
}
