<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatController extends AbstractController
{
    public function index(PlatRepository $platripo,  PaginatorInterface $paginator, Request $request): Response
    {
        $plat = $paginator->paginate(
            $platripo->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('plat/index.html.twig', [
            'plats' => $plat
        ]);
    }

    #[Route('/plat/{id}', name: 'plat_show')]
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat
        ]);
    }
}
