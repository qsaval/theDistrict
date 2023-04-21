<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/commande/{id}', name: 'app_commande')]
    public function index(User $choosenUser): Response
    {
        return $this->render('commande/index.html.twig', [
            'utilisateur' => $choosenUser,
        ]);
    }

    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/commande/{user}/{commande}', name: 'commande_annulee')]
    public function annulee(User $choosenUser, Commande $commande, EntityManagerInterface $em): Response
    {
        $commande->setEtat(4);
        $em->persist($commande);
        $em->flush();
        return $this->redirectToRoute('app_commande', ['id' => $choosenUser->getId()]);
    }
}
