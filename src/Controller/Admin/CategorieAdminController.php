<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieAdminController extends AbstractController
{
    #[Route('/admin/categorie', name: 'admin_categorie')]
    public function categorie(CategorieRepository $ripo, Request $request, PaginatorInterface $paginator): Response
    {
        $categorie = $paginator->paginate(
            $ripo->findAll(),
            $request->query->getInt('page', 1),
            5
        );

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

            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('admin_categorie');
        };

        return $this->render('admin/categorie/newCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/categorie/supresion/{id}', name: 'admin_categorie_delete')]
    public function deleteCategorie(Categorie $categorie, EntityManagerInterface $manager, PlatRepository $platRepository): Response
    {
        $plat = $platRepository->findBy(['categorie' => $categorie->getId()]);

        for($i=0; $i<count($plat); $i++){
            $manager->remove($plat[$i]);
        }

        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin_categorie');
    }
}