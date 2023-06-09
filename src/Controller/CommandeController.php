<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/commande/{id}', name: 'app_commande')]
    public function index(User $choosenUser , CommandeRepository $commandeRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $commande = $paginator->paginate(
            $commandeRepository->findAllDesc($choosenUser->getId()),
            $request->query->getInt('page', 1),
            7
        ); 

        return $this->render('commande/index.html.twig', [
            'utilisateur' => $choosenUser,
            'commandes' => $commande
        ]);
    }

    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/commande/{choosenUser}/{commande}', name: 'commande_annulee')]
    public function annulee(User $choosenUser, Commande $commande, EntityManagerInterface $em): Response
    {
        $commande->setEtat(4);
        $em->persist($commande);
        $em->flush();
        return $this->redirectToRoute('app_commande', ['id' => $choosenUser->getId()]);
    }
}
