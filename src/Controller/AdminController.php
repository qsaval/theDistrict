<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\User;
use App\Form\CategorieType;
use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('admin/commande.html.twig', [
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

    #[Route('/admin/categorie/edition/{id}', name: 'admin_categorie_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editCategorie(Categorie $categorie, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie = $form->getData();

            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('admin_categorie');
        };

        return $this->render('admin/editCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/categorie/new', name: 'admin_categorie_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function newCategorie(Request $request, EntityManagerInterface $manager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie = $form->getData();
            $categorie->setUser($this->getUser());

            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('admin_categorie');
        };

        return $this->render('admin/newCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/categorie/supresion/{id}', name: 'admin_categorie_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteCategorie(Categorie $categorie, EntityManagerInterface $manager): Response
    {
        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin_categorie');
    }

    #[Route('/admin/plat/edition/{id}', name: 'admin_plat_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function editPlat(Plat $plat, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();

            $manager->persist($plat);
            $manager->flush();

            return $this->redirectToRoute('plat');
        };

        return $this->render('admin/editPlat.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/plat/new', name: 'admin_plat_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function newPlat(Request $request, EntityManagerInterface $manager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();
            $plat->setUser($this->getUser());

            $manager->persist($plat);
            $manager->flush();

            return $this->redirectToRoute('admin_plat');
        };

        return $this->render('admin/newPlat.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/plat/supresion/{id}', name: 'admin_plat_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deletePlat(Plat $plat, EntityManagerInterface $manager): Response
    {
        $manager->remove($plat);
        $manager->flush();

        return $this->redirectToRoute('admin_plat');
    }

    #[Route('/admin/commande/supresion/{id}', name: 'admin_commande_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteCommande(Commande $commande, EntityManagerInterface $manager): Response
    {
        $manager->remove($commande);
        $manager->flush();

        return $this->redirectToRoute('admin_commande');
    }

    #[Route('/admin/utilisateur/supresion/{id}', name: 'admin_user_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(User $user, EntityManagerInterface $manager): Response
    {
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('admin_user');
    }
}
