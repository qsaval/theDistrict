<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserAdminController extends AbstractController
{
    #[Route('/admin/utilisateur', name: 'admin_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function user(UserRepository $ripo): Response
    {
        $user = $ripo->findAll();
        return $this->render('admin/user/user.html.twig', [
            'users' => $user,
        ]);
    }

    #[Route('/admin/utilisateur/supresion/{id}', name: 'admin_user_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(User $user, EntityManagerInterface $manager): Response
    {
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('admin_user');
    }
}