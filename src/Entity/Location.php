<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
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
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Donation", mappedBy="locality")
     */
    private $locality;

    public function __construct()
    {
        $this->locality = new ArrayCollection();
    }

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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection|Donation[]
     */
    public function getLocality(): Collection
    {
        return $this->locality;
    }

    public function addLocality(Donation $locality): self
    {
        if (!$this->locality->contains($locality)) {
            $this->locality[] = $locality;
            $locality->setLocality($this);
        }

        return $this;
    }

    public function removeLocality(Donation $locality): self
    {
        if ($this->locality->contains($locality)) {
            $this->locality->removeElement($locality);
            // set the owning side to null (unless already changed)
            if ($locality->getLocality() === $this) {
                $locality->setLocality(null);
            }
        }

        return $this;
    }
}
