<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlatAdminController extends AbstractController
{
    #[Route('/admin/plat', name: 'admin_plat')]
    public function plat(PlatRepository $ripo): Response
    {
        $plat = $ripo->findAll();
        return $this->render('admin/plat/plat.html.twig', [
            'plats' => $plat,
        ]);
    }

    #[Route('/admin/plat/edition/{id}', name: 'admin_plat_edit')]
    public function editPlat(Plat $plat, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();

            $manager->persist($plat);
            $manager->flush();

            return $this->redirectToRoute('admin_plat');
        };

        return $this->render('admin/plat/editPlat.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/plat/new', name: 'admin_plat_new')]
    public function newPlat(Request $request, EntityManagerInterface $manager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $plat = $form->getData();
            $plat->setUser($this->getUser());

            $manager->persist($plat);
            $manager->flush();

            return $this->redirectToRoute('admin_plat');
        };

        return $this->render('admin/plat/newPlat.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/plat/supresion/{id}', name: 'admin_plat_delete')]
    public function deletePlat(Plat $plat, EntityManagerInterface $manager): Response
    {
        $manager->remove($plat);
        $manager->flush();

        return $this->redirectToRoute('admin_plat');
    }
}