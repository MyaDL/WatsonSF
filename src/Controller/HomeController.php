<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'app_home')]
    public function index(): Response
    {

        $user = $this->getUser();
        $userEmail = null;

        if ($user) {
            $userEmail = $user->getEmail();
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user_email' => $userEmail,
        ]);
    }
}

?>