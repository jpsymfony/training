<?php

namespace AppBundle\Repository;

interface PostalCodeRepositoryInterface
{
    /**
     * @param string $postalCode|null
     *
     * @return array
     */
    public function getByPostalCode($postalCode = null);
}