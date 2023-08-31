<?php

namespace App\Controller\admin;

use App\Entity\Block;
use App\Form\BlockType;
use App\Repository\BlockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/block')]
class AdminBlockController extends AbstractController
{
    #[Route('/', name: 'app_admin_block_index', methods: ['GET'])]
    public function index(BlockRepository $blockRepository): Response
    {
        return $this->render('admin_block/index.html.twig', [
            'blocks' => $blockRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_block_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlockRepository $blockRepository): Response
    {
        $block = new Block();
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blockRepository->save($block, true);

            return $this->redirectToRoute('app_admin_block_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_block/new.html.twig', [
            'block' => $block,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_block_show', methods: ['GET'])]
    public function show(Block $block): Response
    {
        return $this->render('admin_block/show.html.twig', [
            'block' => $block,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_block_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Block $block, BlockRepository $blockRepository): Response
    {
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blockRepository->save($block, true);

            return $this->redirectToRoute('app_admin_block_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_block/edit.html.twig', [
            'block' => $block,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_block_delete', methods: ['POST'])]
    public function delete(Request $request, Block $block, BlockRepository $blockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$block->getId(), $request->request->get('_token'))) {
            $blockRepository->remove($block, true);
        }

        return $this->redirectToRoute('app_admin_block_index', [], Response::HTTP_SEE_OTHER);
    }
}
