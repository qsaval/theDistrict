<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieAdminController extends AbstractController
{
    #[Route('/admin/categorie', name: 'admin_categorie')]
    public function categorie(CategorieRepository $ripo): Response
    {
        $categorie = $ripo->findAll();
        return $this->render('admin/categorie/categorie.html.twig', [
            'categories' => $categorie,
        ]);
    }

    #[Route('/admin/categorie/edition/{id}', name: 'admin_categorie_edit')]
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

        return $this->render('admin/categorie/editCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/categorie/new', name: 'admin_categorie_new')]
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

        return $this->render('admin/categorie/newCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/categorie/supresion/{id}', name: 'admin_categorie_delete')]
    public function deleteCategorie(Categorie $categorie, EntityManagerInterface $manager): Response
    {
        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin_categorie');
    }
}