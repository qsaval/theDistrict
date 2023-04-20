<?php

namespace App\Controller;

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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    public function index(CartService $carteService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $carteService->getTotal()
        ]);
    }

    #[Route('/mon-panier/valide', name: 'cart_valide')]
    public function valide(CartService $carteService, Request $request, PlatRepository $repo, EntityManagerInterface $em, MailService $mailService): Response
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

        $mailService->sendValide(
            'serviceClient@thedistrict.com',
            'Commande validée',
            'emails/valide.html.twig',
            $this->getUser()->getEmail()
        );

        $carteService->removeCartAll();

        return $this->redirectToRoute('home');
    }

    #[Route('/mon-panier/add/{id<\d+>}', name: 'cart_add')]
    public function addToRoute(CartService $carteService, int $id): Response
    {
        $carteService->addToCart($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeToCart(CartService $carteService, int $id): Response
    {
        $carteService->removeToCart($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/decrease/{id<\d+>}', name: 'cart_decrease')]

    public function decrease(CartService $cartService, int $id): RedirectResponse
    {
        $cartService->decrease($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/removeAll', name: 'cart_removeAll')]
    public function removeAll(CartService $carteService): Response
    {
        $carteService->removeCartAll();
        return $this->redirectToRoute('cart');
    }
}
