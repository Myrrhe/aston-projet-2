<?php

namespace App\Controller;

use App\Service\StringProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;


class AppController extends AbstractController
{
    #[Route('/all_entities', name: 'all_entities')]
    public function entitiesAction(EntityManagerInterface $entityManager, StringProcessor $stringProcessor) {
        $entities = [];
        $metas = $entityManager->getMetadataFactory()->getAllMetadata();
        foreach ($metas as $meta) {
            $entities[] = $stringProcessor->trimSlash($meta->getName());
        }

        return $this->render('entities.twig', [
            'entities' => $entities
        ]);
    }
}