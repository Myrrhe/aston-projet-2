<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\src\Entity\User;

class UserController extends AbstractController
{
    #[Route('/me', name: 'app_me')]
    public function me(): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            return $this->json([
                'firstname' => $user->getUsername(),
                'lastname' => $user->getEmail(),
            ]);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }
}
