<?php

namespace App\DataFixtures;

use App\Entity\Donation;
use App\Entity\Donor;
use App\Entity\Employee;
use App\Entity\Location;
use App\Entity\Sicktype;
use App\Repository\DonorRepository;
use App\Repository\EmployeeRepository;
use App\Repository\LocationRepository;
use DateInterval;
use DateTime;
use DateTimeZone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $donorRepository;
    private $locationRepository;
    private $employeeRepository;
    private $penc;
    public function __construct(DonorRepository $donorRepository, LocationRepository $locationRepository, EmployeeRepository $employeeRepository, UserPasswordEncoderInterface $penc) {
        $this->donorRepository = $donorRepository;
        $this->locationRepository = $locationRepository;
        $this->employeeRepository = $employeeRepository;
        $this->penc = $penc;
    }

    public function load(ObjectManager $manager)
    {
        $namesArray = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet', 'gold', 'diamond', 'silver', 'bronze'];
        $titleArray = ['mr','dr','mrs','ms','miss','prof', 'pr'];
        $genderArray = ['male', 'female'];
        $maritalStatuses = ['single','married','de facto','divorced'];
        $raceArray = ['asian','cacausian','latina','european','african','mongoloid'];
        $bloodTypes = ['O','A','B','AB'];
        $sickTypes = ['Malaria','Typhoid','Syphilis','HIV/AIDS','Jaundice'];
        $occupationArray = ['self-employed','it office', 'accountant', 'mechanic', 'nurse', 'community leader', 'musician'];
        // create 5 employees ?
        // create 5 locations
        for ($i=0; $i < 5; $i++) { 
            $location = new Location();
            $location
                ->setName('Location '.$i)
                ->setLongitude(rand(-360,360))
                ->setLatitude(rand(-360,360))
            ;
            $employee = new Employee();
            $employee
                ->setPassword($this->penc->encodePassword($employee,'password'))
                ->setUuid($i)
            ;
            $sickness = new Sicktype();
            $sickness->setName($sickTypes[$i]);
            $manager->persist($location);
            $manager->persist($employee);
            $manager->persist($sickness);
            $manager->flush();
        }
        // create 25 donors
        for ($i=0; $i < 25; $i++) {
            $donor = new Donor();
            $donor
                ->setTitle($titleArray[rand(0,6)])
                ->setFirstName($namesArray[rand(0,10)])
                ->setLastName($namesArray[rand(0,10)])
                ->setDob(date_sub(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')), new DateInterval('P'.rand(16,50).'Y'.rand(1,12).'M')))
                ->setGender($genderArray[rand(0,1)])
                ->setMaritalStatus($maritalStatuses[rand(0,3)])
                ->setRace($raceArray[rand(0,5)])
                ->setHomeAddress('PO Box '.rand(11,999))
                ->setPersonalPhoneNumber(rand(71000000,79999999))
                ->setPersonalEmail('user@personal.com')
                ->setBusinessAddress('PO Box '.rand(11,999))
                ->setBusinessPhoneNumber(rand(71000000,79999999))
                ->setBusinessemail('user@business.com')
                ->setBloodType($bloodTypes[rand(0,3)])
                ->setOccupation($occupationArray[rand(0,6)])
            ;
            $manager->persist($donor);
            $manager->flush();
        }
        // create 100 donations
        // for ($i=0; $i < 100; $i++) { 
        //     $donation = new Donation();
        //     $donation
        //         ->setDate(date_sub(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')), new DateInterval('P'.rand(1,84).'D')))
        //         ->setWeight(rand(40,120))
        //         ->setBloodPressure(rand(70,130))
        //         ->setHrbPercentage(rand(0,100))
        //         ->setVolume(rand(0,10000))
        //         ->setDonor($this->donorRepository->find(rand(326, 350)))
        //         ->setLocality($this->locationRepository->find(rand(67,71)))
        //         ->setCollectedBy($this->employeeRepository->findOneBy(['uuid' => rand(0,4)]))
        //         ->setBags(rand(1,5))
        //         ->setConsentGiven(rand(0,1))
        //     ;
        //     $manager->persist($donation);
        // }

        $manager->flush();
    }
}
