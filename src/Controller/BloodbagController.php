<?php

namespace App\Controller;

use App\Entity\Bloodbag;
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
     * @Route("/{id}", name="bloodbag_show", methods={"GET"})
     */
    public function show(Bloodbag $bloodbag): Response
    {
        return $this->render('bloodbag/show.html.twig', [
            'bloodbag' => $bloodbag,
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
