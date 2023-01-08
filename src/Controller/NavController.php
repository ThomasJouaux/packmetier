<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/header', name: 'app_nav')]
    public function index(): Response
    {
        return $this->render('core/header.html.twig', [
            'controller_name' => 'NavController',
        ]);
    }
}
