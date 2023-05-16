<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'categorie')]
    public function index(CategorieRepository $categoriripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $categorie = $paginator->paginate(
            $categoriripo->findAllP(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('categorie/index.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_listPlat')]
    public function listPlat(Categorie $categorie): Response
    {
        return $this->render('categorie/listPlat.html.twig', [
            'categories' => $categorie,
        ]);
    }
}
