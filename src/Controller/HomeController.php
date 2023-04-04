<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request , EntityManagerInterface $manager): Response
    {
        $plat = new Plat;
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();

            $manager->persist($plat);
            $manager->flush();
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/categorie', name: 'categorie')]
    public function categorie(CategorieRepository $categoriripo): Response
    {
        $categorie = $categoriripo->findAll();
        return $this->render('home/categorie.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
    public function show(Categorie $categorie): Response
    {
        return $this->render('home/show.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/plat', name: 'plat')]
    public function plat(PlatRepository $platripo): Response
    {
        $plat = $platripo->findAll();
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
