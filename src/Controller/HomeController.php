<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Contact;
use App\Entity\Categorie;
use App\Form\ContactType;
use App\Form\RechercheType;
use App\Service\MailService;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategorieRepository $Cripo, PlatRepository $Pripo, Request $request): Response
    {
        $categorie = $Cripo->findBy(['favori' => 'Yes']);
        $plat = $Pripo->findBy(['favori' => 'Yes']);

        $form = $this->createForm(RechercheType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $recherche = $form->getData();

            $categorie2 = $Cripo->findAll();
            for ($i=0; $i < count($categorie2); $i++){ 
                if(strtoupper($categorie2[$i]->getLibelle()) == strtoupper($recherche['recherche'])){                    return $this->redirectToRoute('categorie_show', ['id' => $categorie2[$i]->getId()]);
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
            'categories' => $categorie,
            'plats' => $plat,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/plat', name: 'plat')]
    

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, EntityManagerInterface $manager, MailService $mailService): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $mailService->sendEmail(
                $contact->getEmail(),
                $contact->getSuject(),
                'emails/contact.html.twig',
                ['contact' => $contact]
            );


            return $this->redirectToRoute('contact');
        }

        return $this->render('home/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
