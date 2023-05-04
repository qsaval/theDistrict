<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserAdminController extends AbstractController
{
    #[Route('/admin/utilisateur', name: 'admin_user')]
    public function user(UserRepository $ripo, Request $request, PaginatorInterface $paginator): Response
    {
        $user = $paginator->paginate(
            $ripo->findAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/user/user.html.twig', [
            'users' => $user,
        ]);
    }

    #[Route('/admin/utilisateur/supresion/{id}', name: 'admin_user_delete')]
    public function deleteUser(User $user, EntityManagerInterface $manager, CommandeRepository $commandeRepository, DetailRepository $detailRepository): Response
    {
        $commande = $commandeRepository->findBy(['user' => $user->getId()]);

        $detail = $detailRepository->findAll();
        for($i=0; $i<count($detail); $i++){
            for($j=0; $j<count($commande);  $j++){
                if($detail[$i]->getCommande()->getId() == $commande[$j]->getId()){
                    $manager->remove($detail[$i]);
                }
            }
        }

        for($k=0; $k<count($commande); $k++){
            $manager->remove($commande[$k]);
        }

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('admin_user');
    }
}