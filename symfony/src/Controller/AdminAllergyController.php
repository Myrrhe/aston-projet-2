<?php

namespace App\Controller;

use App\Entity\Allergy;
use App\Form\Allergy1Type;
use App\Repository\AllergyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/allergy')]
class AdminAllergyController extends AbstractController
{
    #[Route('/', name: 'app_admin_allergy_index', methods: ['GET'])]
    public function index(AllergyRepository $allergyRepository): Response
    {
        return $this->render('admin_allergy/index.html.twig', [
            'allergies' => $allergyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_allergy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AllergyRepository $allergyRepository): Response
    {
        $allergy = new Allergy();
        $form = $this->createForm(Allergy1Type::class, $allergy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergyRepository->save($allergy, true);

            return $this->redirectToRoute('app_admin_allergy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_allergy/new.html.twig', [
            'allergy' => $allergy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_allergy_show', methods: ['GET'])]
    public function show(Allergy $allergy): Response
    {
        return $this->render('admin_allergy/show.html.twig', [
            'allergy' => $allergy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_allergy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Allergy $allergy, AllergyRepository $allergyRepository): Response
    {
        $form = $this->createForm(Allergy1Type::class, $allergy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergyRepository->save($allergy, true);

            return $this->redirectToRoute('app_admin_allergy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_allergy/edit.html.twig', [
            'allergy' => $allergy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_allergy_delete', methods: ['POST'])]
    public function delete(Request $request, Allergy $allergy, AllergyRepository $allergyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allergy->getId(), $request->request->get('_token'))) {
            $allergyRepository->remove($allergy, true);
        }

        return $this->redirectToRoute('app_admin_allergy_index', [], Response::HTTP_SEE_OTHER);
    }
}
