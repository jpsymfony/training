<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 * @UniqueEntity(fields="email", message="Ce mail existe déjà en base de données.")
 * @UniqueEntity(fields="phoneNumber", message="Ce numéro de téléphone existe déjà en base de données.")
 */
class Contact
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
     * @ORM\Column(name="gender", type="string")
     * @Assert\Choice(choices = {"mister", "misses", "miss"}, message = "Genre invalide.")
     * @Assert\NotBlank(message="La civilité est obligatoire.")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Assert\NotBlank(message="Le nom de famille est obligatoire.")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\NotBlank(message="Le prénom est obligatoire.")
     */
    private $firstName;

    /**
     * @var int
     *
     * @ORM\Column(name="zipCode", type="integer")
     * @AppAssert\ZipCode()
     * @Assert\NotBlank(message="Le code postal est obligatoire.")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message="Email invalide.")
     * @Assert\NotBlank(message="L'email est obligatoire.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, unique=true)
     * @Assert\Regex("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}/")
     * @Assert\NotBlank(message="Le numéro de téléphone est obligatoire.")
     */
    private $phoneNumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="news", type="boolean", nullable=true)
     */
    private $news;

    /**
     * @var bool
     *
     * @ORM\Column(name="optin", type="boolean", nullable=true)
     */
    private $optin;


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
     * Set gender
     *
     * @param integer $gender
     *
     * @return Contact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return Contact
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return int
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Contact
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set news
     *
     * @param boolean $news
     *
     * @return Contact
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return bool
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set optin
     *
     * @param boolean $optin
     *
     * @return Contact
     */
    public function setOptin($optin)
    {
        $this->optin = $optin;

        return $this;
    }

    /**
     * Get optin
     *
     * @return bool
     */
    public function getOptin()
    {
        return $this->optin;
    }
}

