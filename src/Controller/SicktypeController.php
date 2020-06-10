<?php

namespace App\Controller;

use App\Entity\Sicktype;
use App\Form\SicktypeType;
use App\Repository\SicktypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sicktype")
 */
class SicktypeController extends AbstractController
{
    /**
     * @Route("/", name="sicktype_index", methods={"GET"})
     */
    public function index(SicktypeRepository $sicktypeRepository): Response
    {
        return $this->render('sicktype/index.html.twig', [
            'sicktypes' => $sicktypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sicktype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sicktype = new Sicktype();
        $form = $this->createForm(SicktypeType::class, $sicktype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sicktype);
            $entityManager->flush();

            return $this->redirectToRoute('sicktype_new');
        }

        return $this->render('sicktype/new.html.twig', [
            'sicktype' => $sicktype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sicktype_show", methods={"GET"})
     */
    public function show(Sicktype $sicktype): Response
    {
        return $this->render('sicktype/show.html.twig', [
            'sicktype' => $sicktype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sicktype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sicktype $sicktype): Response
    {
        $form = $this->createForm(SicktypeType::class, $sicktype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sicktype_index');
        }

        return $this->render('sicktype/edit.html.twig', [
            'sicktype' => $sicktype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sicktype_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sicktype $sicktype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sicktype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sicktype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sicktype_index');
    }
}
