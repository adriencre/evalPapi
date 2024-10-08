<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeBatterie;
use App\Form\ModifierTypeBatterieType;
use App\Repository\TypeBatterieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TypeBatterieController extends AbstractController
{
    #[Route('/private-liste-typebatterie', name: 'app_liste_typebatterie')]
    public function listeTypeBatterie(TypeBatterieRepository $typeBatterieRepository): Response
    {
        $typeBatteries = $typeBatterieRepository->findAll();

        return $this->render('type_batterie/liste-typebatterie.html.twig', [
            'typeBatteries' => $typeBatteries,
        ]);
    }

    #[Route('/modifier-typebatterie/{id}', name: 'app_modifier_typebatterie')]
    public function modifierTypeBatterie(Request $request, TypeBatterie $typeBatterie, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierTypeBatterieType::class, $typeBatterie);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($typeBatterie);
                $em->flush();
                $this->addFlash('notice', 'Type de batterie modifié');
                return $this->redirectToRoute('app_liste_typebatterie');
            }
        }

        return $this->render('type_batterie/modifier-type_batterie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer-typebatterie/{id}', name: 'app_supprimer_typebatterie')]
public function supprimerTypeBatterie(TypeBatterie $typeBatterie, EntityManagerInterface $em): Response
{
    if ($typeBatterie) {
        $em->remove($typeBatterie);
        $em->flush();
        $this->addFlash('notice', 'Type de batterie supprimé avec succès.');
    }

    return $this->redirectToRoute('app_liste_typebatterie');
}
}
