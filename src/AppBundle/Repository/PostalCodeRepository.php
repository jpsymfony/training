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
        $result = $this
            ->createQueryBuilder('pc')
            ->select('pc.code')
            ->where('pc.code LIKE :postalCode')
            ->setParameter('postalCode', '%' . $postalCode . '%')
            ->getQuery()
            ->getScalarResult();

        return array_map('current', $result);
    }
}
