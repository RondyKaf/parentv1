<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Repository\PinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ["GET"])]
    public function index(PinsRepository $pinsRepository): Response
    {
        $pins = $pinsRepository->findby([],["createdAt"=>""]);
        return $this->render('pins/index.html.twig', [
            "pins" => $pins,
        ]);
    }

    #[Route('/pins/{id<[0-9]+>}', name: 'app_pins_show', methods: ["GET"])]
    public function show(Pins $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }
}