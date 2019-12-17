<?php

namespace App\Controller;

use App\CRUD\Blog\AuthorCRUD;
use App\Entity\Author;
use App\Form\Blog\AuthorFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @param Request $request
     * @param AuthorCRUD $authorCRUD
     * @Route("blog/author/new", name="author_create")

     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAuthor(
        Request $request, authorCrud $authorCRUD
    )
    {

        //create empty author
        $author = new Author();

        //create form
        $form = $this->createForm(
            AuthorFormType::class,
            $author
        );

        //handle form = submit
        $form->handleRequest($request);

        //treat submitted form
        if ($form->isSubmitted() && $form->isValid()) {
            //persit
            $authorCRUD->add($author);

            //redirect
            return $this->redirectToRoute('author_show_all');
        }

        // create and return template
        return $this->render('blog/author/create.html.twig', [
            'authorForm' => $form->createView()
        ]);


    }

    /**
     * @Route("blog/author/all", name="author_show_all")
     * @param AuthorCRUD $authorCRUD
     * @return Response
     */
    public function showAllAuthor(AuthorCRUD $authorCRUD)
    {

        $authors = $authorCRUD->getAll();
        return $this->render('blog/author/all.html.twig', [
            'authors' => $authors
        ]);
    }


    /**
     * @param Request $request
     * @param AuthorCRUD $authorCRUD
     * @param $id
     * @return Response
     * @Route("blog/author/edit/{id}", name="author_edit")
     */
    public function editAuthor( Request $request, AuthorCrud $authorCRUD ,$id)
    {
        //create empty author
        $author = $authorCRUD->getOneById($id);

        //create form
        $form = $this->createForm(
            AuthorFormType::class,
            $author
        );

        //handle form = submit
        $form->handleRequest($request);

        //treat submitted form
        if ($form->isSubmitted() && $form->isValid()) {
            //persit
            $authorCRUD->add($author);

            //redirect
            return $this->redirectToRoute('author_show_all');
        }

        // create and return template
        return $this->render('blog/author/update.html.twig', [
            'authorForm' => $form->createView(),
            'author'=> $author
        ]);




    }

    /**
     * @param Request $request
     * @param AuthorCRUD $authorCRUD
     * @param $id
     * @return Response
     * @Route("blog/author/delete/{id}", name="author_delete")
     */
    public function deleteAuthor(Request $request, AuthorCrud $authorCRUD , $id)
    {
        //create empty author
        $author = $authorCRUD->getOneById($id);
        $authorCRUD->delete($author);
            //redirect
            return $this->redirectToRoute('author_show_all');

    }


    /**
     * @param $id
     * @param AuthorCRUD $authorCRUD
     * @return Response
     * @Route("blog/author/show/{id}", name="author_show_single")
     */
    public function showOneAuthorById($id ,AuthorCRUD $authorCRUD)
    {
        /**
         * @var Author $author
         */
        $author = $authorCRUD->getOneById($id);
        return $this->render('blog/author/one.html.twig',
            ['author' => $author,]);
    }


}
