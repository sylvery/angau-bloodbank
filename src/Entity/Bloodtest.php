<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BloodtestRepository")
 */
class Bloodtest
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sicktype", mappedBy="bloodtest")
     */
    private $sickfound;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bloodbag", mappedBy="bloodtest")
     */
    private $bloodbag;

    public function __construct()
    {
        $this->sickfound = new ArrayCollection();
        $this->bloodbag = new ArrayCollection();
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Sicktype[]
     */
    public function getSickfound(): Collection
    {
        return $this->sickfound;
    }

    public function addSickfound(Sicktype $sickfound): self
    {
        if (!$this->sickfound->contains($sickfound)) {
            $this->sickfound[] = $sickfound;
            $sickfound->setBloodtest($this);
        }

        return $this;
    }

    public function removeSickfound(Sicktype $sickfound): self
    {
        if ($this->sickfound->contains($sickfound)) {
            $this->sickfound->removeElement($sickfound);
            // set the owning side to null (unless already changed)
            if ($sickfound->getBloodtest() === $this) {
                $sickfound->setBloodtest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bloodbag[]
     */
    public function getBloodbag(): Collection
    {
        return $this->bloodbag;
    }

    public function addBloodbag(Bloodbag $bloodbag): self
    {
        if (!$this->bloodbag->contains($bloodbag)) {
            $this->bloodbag[] = $bloodbag;
            $bloodbag->setBloodtest($this);
        }

        return $this;
    }

    public function removeBloodbag(Bloodbag $bloodbag): self
    {
        if ($this->bloodbag->contains($bloodbag)) {
            $this->bloodbag->removeElement($bloodbag);
            // set the owning side to null (unless already changed)
            if ($bloodbag->getBloodtest() === $this) {
                $bloodbag->setBloodtest(null);
            }
        }

        return $this;
    }
}
