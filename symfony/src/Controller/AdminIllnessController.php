<?php

namespace App\Controller;

use App\Entity\Illness;
use App\Form\IllnessType;
use App\Repository\IllnessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/illness')]
class AdminIllnessController extends AbstractController
{
    #[Route('/', name: 'app_admin_illness_index', methods: ['GET'])]
    public function index(IllnessRepository $illnessRepository): Response
    {
        return $this->render('admin_illness/index.html.twig', [
            'illnesses' => $illnessRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_illness_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IllnessRepository $illnessRepository): Response
    {
        $illness = new Illness();
        $form = $this->createForm(IllnessType::class, $illness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $illnessRepository->save($illness, true);

            return $this->redirectToRoute('app_admin_illness_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_illness/new.html.twig', [
            'illness' => $illness,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_illness_show', methods: ['GET'])]
    public function show(Illness $illness): Response
    {
        return $this->render('admin_illness/show.html.twig', [
            'illness' => $illness,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_illness_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Illness $illness, IllnessRepository $illnessRepository): Response
    {
        $form = $this->createForm(IllnessType::class, $illness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $illnessRepository->save($illness, true);

            return $this->redirectToRoute('app_admin_illness_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_illness/edit.html.twig', [
            'illness' => $illness,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_illness_delete', methods: ['POST'])]
    public function delete(Request $request, Illness $illness, IllnessRepository $illnessRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$illness->getId(), $request->request->get('_token'))) {
            $illnessRepository->remove($illness, true);
        }

        return $this->redirectToRoute('app_admin_illness_index', [], Response::HTTP_SEE_OTHER);
    }
}
