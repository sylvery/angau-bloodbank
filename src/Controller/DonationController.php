<?php

namespace App\Controller;

use App\Entity\Bloodtest;
use App\Entity\Donation;
use App\Form\DonationType;
use App\Repository\DonationRepository;
use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

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

            return $this->redirectToRoute('donation_show', ['id' => $donation->getId()]);
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
                $workflow->apply($donation, 'to_physical_checks');
            } else if ($workflow->can($donation, 'to_blood_collection')) {
                $workflow->apply($donation, 'to_blood_collection');
            } else if ($workflow->can($donation, 'to_blood_tests')) {
                $bags = $form->getData()->getBloodbags();
                // var_export($bags); exit;
                $now = new DateTime('now', new DateTimeZone('Pacific/Port_Moresby'));
                foreach ($bags as $bag) {
                    // var_dump($bag); exit;
                    $uuid = random_int(0,16);
                    $bag->setBagnumber($donation->getDonor()->getNameInitials().'_'.$donation->getId().$uuid.'_'.$now->getTimestamp())
                        ->setVolume($bag->getVolume())
                        ->setDonation($donation);
                    $this->getDoctrine()->getManager()->persist($bag);
                    // $this->getDoctrine()->getManager()->flush();
                }
                $workflow->apply($donation, 'to_blood_tests');
            } else if ($workflow->can($donation, 'to_save_bank')) {
                // we'll  be calling serology here to know what types of sicknesses or illnesses are in the blood donated
                $serology = $form->getData()->getSerology();
                $btr = new Bloodtest();
                $btr
                    ->setComment($form->getData()->getTestResult())
                    ->setDate(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')))
                ;
                foreach ($donation->getBloodbags() as $bag) {
                    $bag->setChecked(true);
                    $btr->addBloodbag($bag);
                }
                foreach ($serology as $sick) {
                    $btr->addSickfound($sick);
                }
                $sendToBin = '';
                foreach ($serology as $sickness) {
                    if ($sickness) $sendToBin = true;
                }
                if ( $sendToBin == true) {
                    $workflow->apply($donation, 'to_discard');
                } else {
                    $workflow->apply($donation, 'to_save_bank');
                }
                $this->getDoctrine()->getManager()->persist($btr);
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
