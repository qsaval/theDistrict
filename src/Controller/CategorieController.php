<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'categorie')]
    public function index(CategorieRepository $categoriripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $categorie = $paginator->paginate(
            $categoriripo->findAll(),
            $request->query->getInt('page', 1),
            7
        );

        return $this->render('categorie/index.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
    public function show(Categorie $categorie , PlatRepository $ripo): Response
    {
        $plat = $ripo->findBy(['categorie' => $categorie]);
        return $this->render('categorie/show.html.twig', [
            'categories' => $categorie,
            'plats' => $plat,
        ]);
    }
}
