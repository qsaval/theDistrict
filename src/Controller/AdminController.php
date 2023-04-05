<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/plat', name: 'admin_plat')]
    #[IsGranted('ROLE_ADMIN')]
    public function plat(PlatRepository $ripo): Response
    {
        $plat = $ripo->findAll();
        return $this->render('admin/plat.html.twig', [
            'plats' => $plat,
        ]);
    }

    #[Route('/admin/categorie', name: 'admin_categorie')]
    #[IsGranted('ROLE_ADMIN')]
    public function categorie(CategorieRepository $ripo): Response
    {
        $categorie = $ripo->findAll();
        return $this->render('admin/categorie.html.twig', [
            'categories' => $categorie,
        ]);
    }

    #[Route('/admin/commande', name: 'admin_commande')]
    #[IsGranted('ROLE_ADMIN')]
    public function commande(CommandeRepository $ripo): Response
    {
        $commande = $ripo->findAll();
        return $this->render('admin/categorie.html.twig', [
            'commandes' => $commande,
        ]);
    }

    #[Route('/admin/utilisateur', name: 'admin_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function user(UserRepository $ripo): Response
    {
        $user = $ripo->findAll();
        return $this->render('admin/user.html.twig', [
            'users' => $user,
        ]);
    }
}
