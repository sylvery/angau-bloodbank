<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Form\DonationType;
use App\Repository\DonationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;
use Symfony\Component\Workflow\Exception\LogicException;

/**
 * @Route("/donation")
 */
class DonationController extends AbstractController
{
    private $workflow;
    public function __construct(Registry $workflow)
    {
        $this->workflow = $workflow;
    }
    /**
     * @Route("/", name="donation_index", methods={"GET"})
     */
    public function index(DonationRepository $donationRepository): Response
    {
        return $this->render('donation/index.html.twig', [
            'donations' => $donationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="donation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $donation = new Donation();
        $form = $this->createForm(DonationType::class, $donation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workflow = $this->workflow->get($donation);
            if ($workflow->can($donation, 'to_physical_checks')) {
                $workflow->apply($donation, 'to_physical_checks');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($donation);
            $entityManager->flush();

            return $this->redirectToRoute('donation_index');
        }

        return $this->render('donation/new.html.twig', [
            'donation' => $donation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donation_show", methods={"GET"})
     */
    public function show(Donation $donation): Response
    {
        return $this->render('donation/show.html.twig', [
            'donation' => $donation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="donation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Donation $donation): Response
    {
        $form = $this->createForm(DonationType::class, $donation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workflow = $this->workflow->get($donation);
            if ($workflow->can($donation, 'to_physical_checks')) {
                // $workflow->apply($donation, 'to_physical_checks');
            } else if ($workflow->can($donation, 'to_blood_collection')) {
                $workflow->apply($donation, 'to_blood_collection');
            } else if ($workflow->can($donation, 'to_blood_tests')) {
                $workflow->apply($donation, 'to_blood_tests');
            } else if ($workflow->can($donation, 'to_save_bank')) {
                if ($form->getData()->getHivaids() == false) {
                    $workflow->apply($donation, 'to_save_bank');
                } else {
                    $workflow->apply($donation, 'to_discard');
                }
            }
            
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('donation_show', ['id' => $donation->getId()]);
        }

        return $this->render('donation/edit.html.twig', [
            'donation' => $donation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="donation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Donation $donation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($donation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('donation_index');
    }
}
