<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Service\CartService;
use App\Service\MailService;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Command\Command;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    #[IsGranted('ROLE_USER')]
    public function index(CartService $carteService, Request $request, PlatRepository $repo, EntityManagerInterface $em): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $carteService->getTotal()
        ]);
    }

    #[Route('/mon-panier/valide', name: 'cart_valide')]
    #[IsGranted('ROLE_USER')]
    public function valide(Request $request, PlatRepository $repo, EntityManagerInterface $em, MailService $mailService): Response
    {
        $session = $request->getSession();
        $panier = $session->get('cart', []);

        $commande = new Commande();
        $total = 0;
        foreach($panier as $id => $quantite)
        {
            $plat = $repo->find($id);
            
            $detail = new Detail();
            $detail->setPlat($plat)
            ->setQuantite($quantite);
            $em->persist($detail);
            
            $commande->addDetail($detail);

            $total = $total + ($plat->getPrix() * $quantite);

            

        }
        $commande->setTotal($total)
            ->setEtat(0)
            ->setDateCommande(new \DateTimeImmutable())
            ->setUser($this->getUser());
        $em->persist($commande);

        $em->flush();

        $user = $this->getUser();
        $mailService->sendValide(
            'serviceClient@thedistrict.com',
            'Commande validée',
            'emails/valide.html.twig',
            $user->getEmail()
        );

        return $this->redirectToRoute('home');
    }

    #[Route('/mon-panier/add/{id<\d+>}', name: 'cart_add')]
    #[IsGranted('ROLE_USER')]
    public function addToRoute(CartService $carteService, int $id): Response
    {
        $carteService->addToCart($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/remove/{id<\d+>}', name: 'cart_remove')]
    #[IsGranted('ROLE_USER')]
    public function removeToCart(CartService $carteService, int $id): Response
    {
        $carteService->removeToCart($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/decrease/{id<\d+>}', name: 'cart_decrease')]
    #[IsGranted('ROLE_USER')]
    public function decrease(CartService $cartService, $id): RedirectResponse
    {
        $cartService->decrease($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/removeAll', name: 'cart_removeAll')]
    #[IsGranted('ROLE_USER')]
    public function removeAll(CartService $carteService): Response
    {
        $carteService->removeCartAll();
        return $this->redirectToRoute('cart');
    }
}
