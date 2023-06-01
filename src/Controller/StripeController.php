<?php
 
namespace App\Controller;

use Stripe;
use App\Entity\Commande;
use App\Service\CartService;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class StripeController extends AbstractController
{
    #[Route('/stripe/{commande}', name: 'app_stripe')]
    public function index(Request $request, Commande $commande, PlatRepository $repo): Response
    {
        $session = $request->getSession();
        $panier = $session->get('cart', []);

        foreach($panier as $id => $quantite)
        {
            $plat = $repo->find($id);
            $plats[] = $plat;
            $quantites[$id] = $quantite;
        }       

        return $this->render('stripe/index.html.twig', [
            'stripe_key' => 'pk_test_51N0js9CjO1FIa7oUl6LUVyqSTEvaDZglojbVHB6pUyYD4uQGTqsU8ZGOI5XcRpNtHhNwWxd6VVJZgFi3dWoOz15k00jhs9ESsv',
            'commande' => $commande,
            'plats' => $plats,
            'quantites' => $quantites
        ]);
    }
 
 
    #[Route('/stripe/create-charge/{commande}', name: 'app_stripe_charge', methods: ['POST'])]
    public function createCharge(Request $request, Commande $commande, CartService $cartService)
    {
        Stripe\Stripe::setApiKey('sk_test_51N0js9CjO1FIa7oUhKvQznKvDRO7PBtCu8QVAiXXVR6rXjnd14yFskpIhk0v1qQmmMqe7hXQHxViHLT8SMQNGRtx00hYsctv1E');
        Stripe\Charge::create ([
                "amount" => $commande->getTotal() * 100,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken')
        ]);
        $this->addFlash(
            'success',
            'Payment Successful!'
        );

        $cartService->removeCartAll();
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Set the value of repo
     *
     * @return  self
     */ 
    public function setRepo($repo)
    {
        $this->repo = $repo;

        return $this;
    }
}