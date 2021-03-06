<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BloodbagRepository")
 */
class Bloodbag
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
    private $bagnumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donation", inversedBy="bloodbags")
     */
    private $donation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bloodtest", inversedBy="bloodbag")
     */
    private $bloodtest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $checked;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getId().$this->getBagNumber();
    }

    public function getBagnumber(): ?string
    {
        return $this->bagnumber;
    }

    public function setBagnumber(string $bagnumber): self
    {
        $this->bagnumber = $bagnumber;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

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

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(?bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }
}
