<?php

namespace App\Controller;

use App\Entity\Pins;
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
        $form = $this->createFormBuilder(new Pins)
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        dd
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $pin = new Pins();
            $pin->setTitle($data["title"]);
            $pin->setDescription($data["description"]);

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
}