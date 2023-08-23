<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Repository\PinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    #[Route('/pins', name: 'app_home', methods: ["GET"])]
    public function index(PinsRepository $pinsRepository): Response
    {
        $pins = $pinsRepository->findAll();
        return $this->render('pins/index.html.twig', [
            "pins" => $pins,
        ]);
    }

    #[Route('/pins/{id<[0-9]+>}', name: 'app_pins_show')]
    public function show(Pins $pins): Response
    {
        dd($pins );
    }
}