<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SicktypeRepository")
 */
class Sicktype
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donation", inversedBy="serology")
     */
    private $donation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bloodtest", inversedBy="sickfound")
     */
    private $bloodtest;

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDonation(): ?Donation
    {
        return $this->donation;
    }

    public function setDonation(?Donation $donation): self
    {
        $this->donation = $donation;

        return $this;
    }

    public function getBloodtest(): ?Bloodtest
    {
        return $this->bloodtest;
    }

    public function setBloodtest(?Bloodtest $bloodtest): self
    {
        $this->bloodtest = $bloodtest;

        return $this;
    }
}
