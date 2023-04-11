<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeAdminController extends AbstractController
{
    #[Route('/admin/commande', name: 'admin_commande')]
    #[IsGranted('ROLE_ADMIN')]
    public function commande(CommandeRepository $ripo): Response
    {
        $commande = $ripo->findAll();
        return $this->render('admin/commande/commande.html.twig', [
            'commandes' => $commande,
        ]);
    }

    #[Route('/admin/commande/supresion/{id}', name: 'admin_commande_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteCommande(Commande $commande, EntityManagerInterface $manager): Response
    {
        $manager->remove($commande);
        $manager->flush();

        return $this->redirectToRoute('admin_commande');
    }
}