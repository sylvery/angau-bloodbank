<?php

namespace App\Controller;

use App\Entity\Bloodbag;
use App\Form\BloodbagType;
use App\Repository\BloodbagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bloodbag")
 */
class BloodbagController extends AbstractController
{
    /**
     * @Route("/", name="bloodbag_index", methods={"GET"})
     */
    public function index(BloodbagRepository $bloodbagRepository): Response
    {
        return $this->render('bloodbag/index.html.twig', [
            'bloodbags' => $bloodbagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bloodbag_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bloodbag = new Bloodbag();
        $form = $this->createForm(BloodbagType::class, $bloodbag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bloodbag);
            $entityManager->flush();

            return $this->redirectToRoute('bloodbag_index');
        }

        return $this->render('bloodbag/new.html.twig', [
            'bloodbag' => $bloodbag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloodbag_show", methods={"GET"})
     */
    public function show(Bloodbag $bloodbag): Response
    {
        return $this->render('bloodbag/show.html.twig', [
            'bloodbag' => $bloodbag,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bloodbag_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bloodbag $bloodbag): Response
    {
        $form = $this->createForm(BloodbagType::class, $bloodbag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bloodbag_index');
        }

        return $this->render('bloodbag/edit.html.twig', [
            'bloodbag' => $bloodbag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloodbag_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bloodbag $bloodbag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloodbag->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bloodbag);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bloodbag_index');
    }
}
