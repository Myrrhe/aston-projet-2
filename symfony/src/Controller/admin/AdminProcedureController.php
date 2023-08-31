<?php

namespace App\Controller\admin;

use App\Entity\Procedure;
use App\Form\ProcedureType;
use App\Repository\ProcedureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/procedure')]
class AdminProcedureController extends AbstractController
{
    #[Route('/', name: 'app_admin_procedure_index', methods: ['GET'])]
    public function index(ProcedureRepository $procedureRepository): Response
    {
        return $this->render('admin_procedure/index.html.twig', [
            'procedures' => $procedureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_procedure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProcedureRepository $procedureRepository): Response
    {
        $procedure = new Procedure();
        $form = $this->createForm(ProcedureType::class, $procedure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procedureRepository->save($procedure, true);

            return $this->redirectToRoute('app_admin_procedure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_procedure/new.html.twig', [
            'procedure' => $procedure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_procedure_show', methods: ['GET'])]
    public function show(Procedure $procedure): Response
    {
        return $this->render('admin_procedure/show.html.twig', [
            'procedure' => $procedure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_procedure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Procedure $procedure, ProcedureRepository $procedureRepository): Response
    {
        $form = $this->createForm(ProcedureType::class, $procedure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procedureRepository->save($procedure, true);

            return $this->redirectToRoute('app_admin_procedure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_procedure/edit.html.twig', [
            'procedure' => $procedure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_procedure_delete', methods: ['POST'])]
    public function delete(Request $request, Procedure $procedure, ProcedureRepository $procedureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$procedure->getId(), $request->request->get('_token'))) {
            $procedureRepository->remove($procedure, true);
        }

        return $this->redirectToRoute('app_admin_procedure_index', [], Response::HTTP_SEE_OTHER);
    }
}
