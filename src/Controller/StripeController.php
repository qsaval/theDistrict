<?php
 
namespace App\Controller;

use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe;
 
class StripeController extends AbstractController
{
    #[Route('/stripe/{commande}', name: 'app_stripe')]
    public function index(Commande $commande): Response
    {
        return $this->render('stripe/index.html.twig', [
            'stripe_key' => 'pk_test_51N0js9CjO1FIa7oUl6LUVyqSTEvaDZglojbVHB6pUyYD4uQGTqsU8ZGOI5XcRpNtHhNwWxd6VVJZgFi3dWoOz15k00jhs9ESsv',
            'commande' => $commande
        ]);
    }
 
 
    #[Route('/stripe/create-charge', name: 'app_stripe_charge', methods: ['POST'])]
    public function createCharge(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51N0js9CjO1FIa7oUhKvQznKvDRO7PBtCu8QVAiXXVR6rXjnd14yFskpIhk0v1qQmmMqe7hXQHxViHLT8SMQNGRtx00hYsctv1E');
        Stripe\Charge::create ([
                "amount" => 5 * 100,
                "currency" => "euro",
                "source" => $request->request->get('stripeToken')
        ]);
        $this->addFlash(
            'success',
            'Payment Successful!'
        );
        return $this->redirectToRoute('app_stripe', [], Response::HTTP_SEE_OTHER);
    }
}