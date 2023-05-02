<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlatController extends AbstractController
{
    #[Route('/plat', name: 'plat')]
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

    #[Route('/plat/{id}', name: 'plat_detail')]
    public function detail(Plat $plat): Response
    {
        return $this->render('plat/detail.html.twig', [
            'plat' => $plat
        ]);
    }
}
