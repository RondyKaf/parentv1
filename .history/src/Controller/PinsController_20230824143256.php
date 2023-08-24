<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Form\PinType;
use App\Repository\PinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{

    #[Route('/', name: 'app_home', methods: ["GET"])]
    public function index(PinsRepository $pinsRepository): Response
    {
        $pins = $pinsRepository->findby([], ["createdAt" => "DESC"]);
        return $this->render('pins/index.html.twig', [
            "pins" => $pins,
        ]);
    }

    #[Route('/pins/create', name: 'app_create_pin', methods: ["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pin = new Pins();
        $form = $this->createForm(PinType::class, $pin, ["method" => "POST"]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pin = $form->getData();
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');

        }
        return $this->render(
            'pins/create.html.twig',
            ["Form" => $form->createView()]
        );
    }
    #[Route('/pins/{id<[0-9]+>}', name: 'app_pins_show', methods: ["GET", "POST"])]
    public function show(Pins $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }

    #[Route('/pins/{id<[0-9]+>}/edit/', name: 'app_pins_edit', methods: ["POST", "GET"])]
    public function edit(Pins $pin, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(
            PinType::class,
            $pin,
            ['method' => 'POST']
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('pins/edit.html.twig', ["form" => $form->createView(), "pin" => $pin]);
    }

    #[Route('/pins/{id<[0-9]+>}/delete/', name: 'app_pins_delete', methods: ["GET"])]
    public function delete(Pins $pin, EntityManagerInterface $em, Request $request): Response
    {
        $csrfToken = $request->request->get("csrf_token");
        if ($this->isCsrfTokenValid('pin-deletion_' . $pin->getId())) {
            $em->remove($pin);
            $em->flush();
        }


        return $this->redirectToRoute('app_home');
    }

}