<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Voiture;
use App\Form\ImageUrlType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture/{id}/ajouter-images', name: 'voiture_ajouter_images')]
    public function ajouterImages(Request $request, Voiture $voiture, ImagesRepository $imagesRepository)
    {
        // Créer un objet Image pour ajouter l'URL
        $image = new Images();

        // Créer le formulaire pour ajouter l'URL d'image
        $form = $this->createForm(ImageUrlType::class, $image);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Associer l'image à la voiture
            $image->setVoiture($voiture);

            // Sauvegarder l'image dans la base de données
            $imagesRepository->save($image, true);

            // Ajouter un message de succès
            $this->addFlash('success', 'Image ajoutée avec succès.');

            // Rediriger vers la page des détails de la voiture
            return $this->redirectToRoute('vente_show', ['id' => $voiture->getId()]);
        }

        return $this->render('voiture/ajouter_images.html.twig', [
            'form' => $form->createView(),
            'voiture' => $voiture,
        ]);
    }
}