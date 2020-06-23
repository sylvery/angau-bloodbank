<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonorRepository")
 */
class Donor
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $homeAddress;    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personalEmail;

    /**
     * @ORM\Column(type="integer")
     */
    private $personalPhoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $businessAddress;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $businessemail;

    /**
     * @ORM\Column(type="integer")
     */
    private $businessPhoneNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $occupation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bloodType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Donation", mappedBy="donor")
     */
    private $donations;

    public function __construct()
    {
        $this->donations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function getNameInitials()
    {
        return substr($this->getFirstName(),0,1).$this->getLastName();
    }

    public function getFullName()
    {
        return $this->getFirstName().' '.$this->getMiddleName().' '.$this->getLastName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getDonorAge()
    {
        return date_diff($this->getDob(), new \DateTime('now'));
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getBloodType(): ?string
    {
        return $this->bloodType;
    }

    public function setBloodType(string $bloodType): self
    {
        $this->bloodType = $bloodType;

        return $this;
    }

    /**
     * @return Collection|Donation[]
     */
    public function getDonations(): Collection
    {
        return $this->donations;
    }

    public function addDonation(Donation $donation): self
    {
        if (!$this->donations->contains($donation)) {
            $this->donations[] = $donation;
            $donation->setDonor($this);
        }

        return $this;
    }

    public function removeDonation(Donation $donation): self
    {
        if ($this->donations->contains($donation)) {
            $this->donations->removeElement($donation);
            // set the owning side to null (unless already changed)
            if ($donation->getDonor() === $this) {
                $donation->setDonor(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getHomeAddress(): ?string
    {
        return $this->homeAddress;
    }

    public function setHomeAddress(string $homeAddress): self
    {
        $this->homeAddress = $homeAddress;

        return $this;
    }

    public function getPersonalEmail(): ?string
    {
        return $this->personalEmail;
    }

    public function setPersonalEmail(string $personalEmail): self
    {
        $this->personalEmail = $personalEmail;

        return $this;
    }

    public function getPersonalPhoneNumber(): ?int
    {
        return $this->personalPhoneNumber;
    }

    public function setPersonalPhoneNumber(int $personalPhoneNumber): self
    {
        $this->personalPhoneNumber = $personalPhoneNumber;

        return $this;
    }

    public function getBusinessAddress(): ?string
    {
        return $this->businessAddress;
    }

    public function setBusinessAddress(string $businessAddress): self
    {
        $this->businessAddress = $businessAddress;

        return $this;
    }

    public function getBusinessemail(): ?string
    {
        return $this->businessemail;
    }

    public function setBusinessemail(string $businessemail): self
    {
        $this->businessemail = $businessemail;

        return $this;
    }

    public function getBusinessPhoneNumber(): ?int
    {
        return $this->businessPhoneNumber;
    }

    public function setBusinessPhoneNumber(int $businessPhoneNumber): self
    {
        $this->businessPhoneNumber = $businessPhoneNumber;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }
}
