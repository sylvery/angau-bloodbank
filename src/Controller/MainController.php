<?php

namespace App\Controller;

use App\Repository\DonationRepository;
use App\Repository\DonorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DonationRepository $donations, DonorRepository $donors)
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'donations' => $donations->findBy(['currentPlace' => 'save_bank'],[],10),
            'donors' => $donors->findBy([],[],10),
        ]);
    }
}
