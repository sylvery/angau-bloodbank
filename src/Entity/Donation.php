<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bloodPressure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hrbPercentage;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="donations")
     */
    private $donor;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $currentPlace;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sicktype", mappedBy="donation", cascade={"persist","remove"})
     */
    private $serology;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="locality")
     */
    private $locality;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bags;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $consentGiven;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="donationsCollected")
     */
    private $collectedBy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $testresult;

    public function __construct()
    {
        $this->serology = new ArrayCollection();
    }

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

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getBloodPressure(): ?int
    {
        return $this->bloodPressure;
    }

    public function setBloodPressure(?int $bloodPressure): self
    {
        $this->bloodPressure = $bloodPressure;

        return $this;
    }

    public function getHrbPercentage(): ?int
    {
        return $this->hrbPercentage;
    }

    public function setHrbPercentage(?int $hrbPercentage): self
    {
        $this->hrbPercentage = $hrbPercentage;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

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

    public function getBags(): ?int
    {
        return $this->bags;
    }

    public function setBags(int $bags): self
    {
        $this->bags = $bags;

        return $this;
    }

    public function getConsentGiven(): ?bool
    {
        return $this->consentGiven;
    }

    public function setConsentGiven(?bool $consentGiven): self
    {
        $this->consentGiven = $consentGiven;

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

    /**
     * @return Collection|Sicktype[]
     */
    public function getSerology(): Collection
    {
        return $this->serology;
    }

    public function addSerology(Sicktype $serology): self
    {
        if (!$this->serology->contains($serology)) {
            $this->serology[] = $serology;
            $serology->setDonation($this);
        }

        return $this;
    }

    public function removeSerology(Sicktype $serology): self
    {
        if ($this->serology->contains($serology)) {
            $this->serology->removeElement($serology);
            // set the owning side to null (unless already changed)
            if ($serology->getDonation() === $this) {
                $serology->setDonation(null);
            }
        }

        return $this;
    }

    public function getLocality(): ?Location
    {
        return $this->locality;
    }

    public function setLocality(?Location $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getCollectedBy(): ?Employee
    {
        return $this->collectedBy;
    }

    public function setCollectedBy(?Employee $collectedBy): self
    {
        $this->collectedBy = $collectedBy;

        return $this;
    }

    public function getTestresult(): ?string
    {
        return $this->testresult;
    }

    public function setTestresult(?string $testresult): self
    {
        $this->testresult = $testresult;

        return $this;
    }

}
