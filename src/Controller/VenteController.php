<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VenteController extends AbstractController
{
    #[Route('/vente', name: 'app_vente')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager->getRepository(Voiture::class)->findAll();

        return $this->render('vente.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    #[Route('/vente/add', name: 'vente_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_vente');
        }

        return $this->render('ajout_voiture.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/vente/{id}', name: 'vente_show')]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $voiture = $entityManager->getRepository(Voiture::class)->find($id);

        return $this->render('detail_voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    
}
