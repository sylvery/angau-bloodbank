<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonationRepository")
 */
class Donation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     */
    private $volume;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     */
    private $bags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="donations")
     */
    private $donor;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $currentPlace;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ampleBlood;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $wasSick;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hivaids;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $malaria;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $covid19;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $whatSick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDonor(): ?Donor
    {
        return $this->donor;
    }

    public function setDonor(?Donor $donor): self
    {
        $this->donor = $donor;

        return $this;
    }

    public function getVolume(): ?string
    {
        return $this->volume;
    }

    public function setVolume(string $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getBags(): ?float
    {
        return $this->bags;
    }

    public function setBags(float $bags): self
    {
        $this->bags = $bags;

        return $this;
    }

    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace): self
    {
        $this->currentPlace = $currentPlace;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getAmpleBlood(): ?bool
    {
        return $this->ampleBlood;
    }

    public function setAmpleBlood(?bool $ampleBlood): self
    {
        $this->ampleBlood = $ampleBlood;

        return $this;
    }

    public function getWasSick(): ?bool
    {
        return $this->wasSick;
    }

    public function setWasSick(?bool $wasSick): self
    {
        $this->wasSick = $wasSick;

        return $this;
    }

    public function getWhatSick(): ?string
    {
        return $this->whatSick;
    }

    public function setWhatSick(?string $whatSick): self
    {
        $this->whatSick = $whatSick;

        return $this;
    }

    public function getHivaids(): ?bool
    {
        return $this->hivaids;
    }

    public function setHivaids(?bool $hivaids): self
    {
        $this->hivaids = $hivaids;

        return $this;
    }

    public function getMalaria(): ?bool
    {
        return $this->malaria;
    }

    public function setMalaria(?bool $malaria): self
    {
        $this->malaria = $malaria;

        return $this;
    }

    public function getCovid19(): ?bool
    {
        return $this->covid19;
    }

    public function setCovid19(?bool $covid19): self
    {
        $this->covid19 = $covid19;

        return $this;
    }
}
