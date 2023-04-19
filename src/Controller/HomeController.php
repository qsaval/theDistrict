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
        $i = 1;
        $categories = array();
        while(count($categories) != 6)
        {
            $categorie = $Cripo->find($i);
            if($categorie->isActive()){
                $categories [] = $categorie;
            }
            
            $i++;
        }

        $j = 1;
        $plats = array();
        while(count($plats) != 3)
        {
            $plat = $Pripo->find($j);
            if($plat->isActive()){
                $plats [] = $plat;
            }
            
            $j++;
        }

        $form = $this->createForm(RechercheType::class);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $recherche = $form->getData();
            
            $categorie2 = $Cripo->findAll();
            for ($i=0; $i < count($categorie2); $i++){ 
                if(strtoupper($categorie2[$i]->getLibelle()) == strtoupper($recherche['recherche'])){  
                    return $this->redirectToRoute('categorie_show', ['id' => $categorie2[$i]->getId()]);
                }
            }
            
            $plat2 = $Pripo->findAll();
            for ($j=0; $j < count($plat2); $j++){ 
                if(strtoupper($plat2[$j]->getLibelle()) == strtoupper($recherche['recherche'])){
                    return $this->redirectToRoute('plat_show', ['id' => $plat2[$j]->getId()]);
                }
            }
        };

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'plats' => $plats,
            'form' => $form->createView(),
        ]);
    }
}
