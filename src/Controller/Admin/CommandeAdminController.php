<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeAdminController extends AbstractController
{
    #[Route('/admin/commande', name: 'admin_commande')]
    public function commande(CommandeRepository $ripo, Request $request, PaginatorInterface $paginator): Response
    {
        $commande = $paginator->paginate(
            $ripo->findAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/commande/commande.html.twig', [
            'commandes' => $commande,
        ]);
    }

    #[Route('/admin/commande/edition/{id}', name: 'admin_commande_edit')]
    public function editCommande(Commande $commande, EntityManagerInterface $manager): Response
    {
        if($commande->getEtat() < 3){
            $commande->setEtat($commande->getEtat() + 1);
        }

        $manager->persist($commande);
        $manager->flush();

        return $this->redirectToRoute('admin_commande');
    }

    #[Route('/admin/commande/supresion/{id}', name: 'admin_commande_delete')]
    public function deleteCommande(Commande $commande, EntityManagerInterface $manager, DetailRepository $detailRepository): Response
    {
        $manager->remove($commande);
        $manager->flush();

        return $this->redirectToRoute('admin_commande');
    }
}