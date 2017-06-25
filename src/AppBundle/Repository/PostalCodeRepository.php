<?php

namespace AppBundle\Repository;

class PostalCodeRepository extends \Doctrine\ORM\EntityRepository implements PostalCodeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getByPostalCode($postalCode = null)
    {
        $result = $this
            ->createQueryBuilder('pc')
            ->select('pc.code')
            ->where('pc.code LIKE :postalCode')
            ->setParameter('postalCode', '%' . $postalCode . '%')
            ->setMaxResults(10)
            ->getQuery()
            ->getScalarResult();

        return array_map('current', $result);
    }
}
