<?php

namespace App\Controller;

use App\Entity\Tshirt;
use App\Form\TshirtType;
use App\Repository\TshirtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ShirtController extends AbstractController
{
    #[Route('/tshirt', name: 'app_tshirt')]
    public function index(TshirtRepository $tshirtRepository): Response
    {
        $tshirts = $tshirtRepository->findAll();
        return $this->render('tshirt/index.html.twig', [
            'tshirts' => $tshirts,
        ]);
    }
    #[Route('/tshirt/create', name: 'tshirt_create')]
    public function create(EntityManagerInterface $manager, Request $request): Response
    {
        $tshirt = new Tshirt();
        $tshirtForm = $this->createForm(TshirtType::class, $tshirt);
        $tshirtForm->handleRequest($request);
        if ($tshirtForm->isSubmitted()) {
            $manager->persist($tshirt);
            $manager->flush();
            return $this->redirectToRoute('app_tshirt');
        }

        return $this->render('tshirt/create.html.twig', [
            'form'=>$tshirtForm->createView(),
        ]);

    }
    #[Route('/tshirt/{id}', name: 'tshirt_show', priority: -1)]
    public function show(Tshirt $tshirt): Response
    {
        if(!$tshirt){
            return $this->redirectToRoute('app_tshirt');
        }
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


    #[Route('/tshirt/edit/{id}', name: 'tshirt_edit')]
    public function edit(Tshirt $tshirt, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$tshirt){
            return $this->redirectToRoute('app_tshirt');
        }
        $tshirtForm = $this->createForm(TshirtType::class, $tshirt);
        $tshirtForm->handleRequest($request);
        if ($tshirtForm->isSubmitted()) {
            $manager->persist($tshirt);
            $manager->flush();
            return $this->redirectToRoute('app_tshirt');
        }
        return $this->render('tshirt/edit.html.twig', [
            'form' => $tshirtForm->createView(),
        ]);
    }

}
