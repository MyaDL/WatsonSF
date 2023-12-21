<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(Security $security): Response
    {
        $user = $security->getUser();
        $controllerName = 'DashboardController';

        if ($user) {
            // L'utilisateur est connecté
            return $this->render('dashboard/index.html.twig', [
                'user' => $user, 'controller_name' => $controllerName
            ]);
        } else {
            // Redirection vers le login
            return $this->redirectToRoute('login');
        }
    }
}
