<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkType;
use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/link')]
class LinkController extends AbstractController
{
    #[Route('/', name: 'app_link_index', methods: ['GET'])]
    public function index(LinkRepository $linkRepository): Response
    {

        $user = $this->getUser();
        $userEmail = null;

        if ($user) {
            $userEmail = $user->getEmail();
        }
        
        return $this->render('link/index.html.twig', [
            'links' => $linkRepository->findAll(),
            'user_email' => $userEmail,
        ]);
    }

    #[Route('/new', name: 'app_link_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($link);
            $entityManager->flush();

            return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();
        $userEmail = null;
        $isUpdate = false;

        if ($user) {
            $userEmail = $user->getEmail();
        }

        return $this->renderForm('link/new.html.twig', [
            'link' => $link,
            'form' => $form,
            'user_email' => $userEmail,
            'isUpdate' => $isUpdate,
        ]);
    }

    #[Route('/{id}', name: 'app_link_show', methods: ['GET'])]
    public function show(Link $link): Response
    {
        $user = $this->getUser();
        $userEmail = null;

        if ($user) {
            $userEmail = $user->getEmail();
        }

        return $this->render('link/show.html.twig', [
            'link' => $link,
            'user_email' => $userEmail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_link_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function edit(Request $request, Link $link, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();
        $userEmail = null;
        $isUpdate = true;

        if ($user) {
            $userEmail = $user->getEmail();
        }

        return $this->renderForm('link/edit.html.twig', [
            'link' => $link,
            'form' => $form,
            'user_email' => $userEmail,
            'isUpdate' => $isUpdate,
        ]);
    }

    #[Route('/{id}', name: 'app_link_delete', methods: ['POST'])]
    #[IsGranted("ROLE_USER")]
    public function delete(Request $request, Link $link, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$link->getId(), $request->request->get('_token'))) {
            $entityManager->remove($link);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
    }
}
