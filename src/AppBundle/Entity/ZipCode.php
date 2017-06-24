<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * ZipCode
 *
 * @ORM\Table(name="zip_code")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZipCodeRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class ZipCode
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer", unique=true)
     * @Serializer\Expose
     */
    private $code;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return ZipCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
}

