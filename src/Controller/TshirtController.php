<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TshirtController extends AbstractController
{
    #[Route('/tshirt', name: 'app_tshirt')]
    public function index(): Response
    {
        return $this->render('tshirt/index.html.twig', [
            'controller_name' => 'TshirtController',
        ]);
    }
}
