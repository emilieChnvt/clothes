<?php

namespace App\Controller;

use App\Entity\Tshirt;
use App\Repository\TshirtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TshirtController extends AbstractController
{
    #[Route('/tshirt', name: 'app_tshirt')]
    public function index(TshirtRepository $tshirtRepository): Response
    {
        $tshirts = $tshirtRepository->findAll();
        return $this->render('tshirt/index.html.twig', [
            'tshirts' => $tshirts,
        ]);
    }

    #[Route('/tshirt/{id}', name: 'tshirt_show')]
    public function show(Tshirt $tshirt): Response
    {
        return $this->render('tshirt/show.html.twig', [
            'tshirt' => $tshirt,
        ]);
    }

    #[Route('/tshirt/delete/{id}', name: 'tshirt_delete')]
    public function delete(Tshirt $tshirt, TshirtRepository $tshirtRepository, EntityManagerInterface $manager): Response
    {
        $manager->remove($tshirt);
        $manager->flush();
        return $this->redirectToRoute('app_tshirt');

    }

}
