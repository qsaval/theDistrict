<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Categorie;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategorieRepository $ripo): Response
    {
        $categorie1 = $ripo->find(1);
        $categorie2 = $ripo->find(2);
        $categorie3 = $ripo->find(3);

        return $this->render('home/index.html.twig', [
            'categorie1' => $categorie1,
            'categorie2' => $categorie2,
            'categorie3' => $categorie3,
        ]);
    }

    #[Route('/categorie', name: 'categorie')]
    public function categorie(CategorieRepository $categoriripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $categorie = $paginator->paginate(
            $categoriripo->findAll(),
            $request->query->getInt('page', 1),
            7
        );

        return $this->render('home/categorie.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
    public function show(Categorie $categorie , PlatRepository $ripo): Response
    {
        $plat = $ripo->findBy(['categorie' => $categorie]);
        return $this->render('home/show.html.twig', [
            'categories' => $categorie,
            'plats' => $plat,
        ]);
    }

    #[Route('/plat', name: 'plat')]
    public function plat(PlatRepository $platripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $plat = $paginator->paginate(
            $platripo->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('home/plat.html.twig', [
            'plats' => $plat
        ]);
    }

    #[Route('/plat/{id}', name: 'plat_show')]
    public function show2(Plat $plat): Response
    {
        return $this->render('home/show2.html.twig', [
            'plat' => $plat
        ]);
    }
}
