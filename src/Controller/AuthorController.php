<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/author")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class AuthorController extends Controller
{
    /**
     * @Route("", name="author_index", methods="GET")
     */
    public function index(AuthorRepository $authorRepository, Request $request): Response
    {
        return $this->render('author/index.html.twig', [
            'authors' => $authorRepository->findWithLimit($request->query->getInt('limit', 100)),
        ]);
    }

    /**
     * @Route("/new", name="author_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('author_index');
        }

        return $this->render('author/new.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="author_show", methods="GET", requirements={"id"="\d+"})
     */
    public function show(Author $author): Response
    {
        return $this->render('author/show.html.twig', ['author' => $author]);
    }

    /**
     * @Route("/{id}/edit", name="author_edit", methods="GET|POST", requirements={"id"="\d+"})
     */
    public function edit(Request $request, $id, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('author_edit', ['id' => $author->getId()]);
        }

        return $this->render('author/edit.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="author_delete", methods="DELETE", requirements={"id"="\d+"})
     */
    public function delete(Request $request, Author $author): Response
    {
        if ($this->isCsrfTokenValid('delete'.$author->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($author);
            $em->flush();
        }

        return $this->redirectToRoute('author_index');
    }
}
