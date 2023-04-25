<?php

namespace App\Controller;


use App\Form\RechercheType;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategorieRepository $Cripo, PlatRepository $Pripo, Request $request): Response
    {
        $categories = $Cripo->findMany(6);

        $plats = $Pripo->findMany(3);

        $form = $this->createForm(RechercheType::class);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $recherche = $form->getData();
 
            if($Cripo->findBy(['libelle' => $recherche])){ 
                $categorie2 = $Cripo->findOneBy(['libelle' => $recherche]);
                return $this->redirectToRoute('categorie_show', ['id' => $categorie2->getId()]);
            }

            if($Pripo->findBy(['libelle' => $recherche])){ 
                $plat2 = $Pripo->findOneBy(['libelle' => $recherche]);
                return $this->redirectToRoute('plat_show', ['id' => $plat2->getId()]);
            }
        };

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'plats' => $plats,
            'form' => $form->createView(),
        ]);
    }
}
