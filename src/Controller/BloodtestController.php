<?php

namespace App\Controller;

use App\Entity\Bloodtest;
use App\Form\BloodtestType;
use App\Repository\BloodtestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bloodtest")
 */
class BloodtestController extends AbstractController
{
    /**
     * @Route("/", name="bloodtest_index", methods={"GET"})
     */
    public function index(BloodtestRepository $bloodtestRepository): Response
    {
        return $this->render('bloodtest/index.html.twig', [
            'bloodtests' => $bloodtestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bloodtest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bloodtest = new Bloodtest();
        $form = $this->createForm(BloodtestType::class, $bloodtest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bags = $form->getData()->getBloodbag();
            $sick = $form->getData()->getSickfound();
            foreach ($bags as $bag) {
                $bag
                    ->setChecked(1)
                    ->setBloodtest($bloodtest)
                ;
            }
            if ($sick) {
                // bloodbag gets marked and goes to disposal
                var_dump($sick->getName()); exit;
            } else {
                // bloodbag gets marked and goes to bank for storage
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bloodtest);
            $entityManager->flush();

            return $this->redirectToRoute('bloodtest_index');
        }

        return $this->render('bloodtest/new.html.twig', [
            'bloodtest' => $bloodtest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloodtest_show", methods={"GET"})
     */
    public function show(Bloodtest $bloodtest): Response
    {
        return $this->render('bloodtest/show.html.twig', [
            'bloodtest' => $bloodtest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bloodtest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bloodtest $bloodtest): Response
    {
        $form = $this->createForm(BloodtestType::class, $bloodtest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bags = $form->getData()->getBloodbag();
            $sick = $form->getData()->getSickfound();
            foreach ($bags as $bag) {
                $bag
                    ->setChecked(1)
                    ->setBloodtest($bloodtest)
                ;
            }
            if ($sick) {
                // bloodbag gets marked and goes to disposal
            } else {
                // bloodbag gets marked and goes to bank for storage
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bloodtest_index');
        }

        return $this->render('bloodtest/edit.html.twig', [
            'bloodtest' => $bloodtest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloodtest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bloodtest $bloodtest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloodtest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bloodtest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bloodtest_index');
    }
}
