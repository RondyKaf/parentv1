<?php

namespace App\Controller;

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

    #[Route('/pins', name: 'app_home', methods: ["GET"])]
    public function show(PinsRepository $pinsRepository): Response
    {
        $pins = $pinsRepository->findAll();
        return $this->render('pins/index.html.twig', [
            "pins" => $pins,
        ]);
    }
}