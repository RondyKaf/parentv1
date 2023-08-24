<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Repository\PinsRepository;
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

    #[Route('/pins/create', name: 'app_create_pin')]
    public function create(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->getForm()
        ;

        $fo
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