<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLogoutController extends AbstractController
{
    #[Route('/admin/logout', name: 'app_admin_logout')]
    public function index(): Response
    {
        return $this->render('admin_logout/index.html.twig', [
            'controller_name' => 'AdminLogoutController',
        ]);
    }
}
