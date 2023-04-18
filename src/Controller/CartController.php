<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    #[IsGranted('ROLE_USER')]
    public function index(CartService $carteService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $carteService->getTotal()
        ]);
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
