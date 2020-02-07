<?php

namespace App\Controller;

use App\Entity\Donor;
use App\Form\DonorType;
use App\Repository\DonorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/donor")
 */
class DonorController extends AbstractController
{
    /**
     * @Route("/", name="donor_index", methods={"GET"})
     */
    public function index(DonorRepository $donorRepository): Response
    {
        return $this->render('donor/index.html.twig', [
            'donors' => $donorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="donor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $donor = new Donor();
        $form = $this->createForm(DonorType::class, $donor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($donor);
            $entityManager->flush();

            return $this->redirectToRoute('donor_index');
        }

        return $this->render('donor/new.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_show", methods={"GET"})
     */
    public function show(Donor $donor): Response
    {
        return $this->render('donor/show.html.twig', [
            'donor' => $donor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="donor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Donor $donor): Response
    {
        $form = $this->createForm(DonorType::class, $donor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donor_index');
        }

        return $this->render('donor/edit.html.twig', [
            'donor' => $donor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Donor $donor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($donor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('donor_index');
    }
}
