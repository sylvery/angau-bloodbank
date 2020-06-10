<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $uuid;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Donation", mappedBy="collectedBy")
     */
    private $donationsCollected;

    public function __construct()
    {
        $this->donationsCollected = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Donation[]
     */
    public function getDonationsCollected(): Collection
    {
        return $this->donationsCollected;
    }

    public function addDonationsCollected(Donation $donationsCollected): self
    {
        if (!$this->donationsCollected->contains($donationsCollected)) {
            $this->donationsCollected[] = $donationsCollected;
            $donationsCollected->setCollectedBy($this);
        }

        return $this;
    }

    public function removeDonationsCollected(Donation $donationsCollected): self
    {
        if ($this->donationsCollected->contains($donationsCollected)) {
            $this->donationsCollected->removeElement($donationsCollected);
            // set the owning side to null (unless already changed)
            if ($donationsCollected->getCollectedBy() === $this) {
                $donationsCollected->setCollectedBy(null);
            }
        }

        return $this;
    }
}
