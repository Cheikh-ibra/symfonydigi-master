<?php

namespace App\Controller;

use App\CRUD\Blog\ArticleCRUD;
use App\CRUD\Blog\AuthorCRUD;
use App\Entity\Article;
use App\Form\Blog\ArticleFormType;
use App\Form\Blog\AuthorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @param ArticleCRUD $articleCRUD
     * @return Response
     * @Route("/blog/all", name="blog_show_all_articles")
     */
    public function showAllArticles(ArticleCRUD $articleCRUD)
    {
        $articles = $articleCRUD->getAll();
        return $this->render('blog/articles/all.html.twig',[
            'articles' => $articles
        ]);
    }


    /**
     * @param Request $request
     * @param ArticleCRUD $articleCRUD
     * @return Response
     * @Route("/blog/article/new", name="blog_create_article")
     */
    public function createArticle(Request $request, ArticleCRUD $articleCRUD)
    {
        {

            //create empty author
            $article = new Article();

            //create form
            $form = $this->createForm(
                ArticleFormType::class,
                $article
            );

            //handle form = submit
            $form->handleRequest($request);

            //treat submitted form
            if ($form->isSubmitted() && $form->isValid()) {
                //persit
                $articleCRUD->add($article);

                //redirect
                return $this->redirectToRoute('blog_show_all_articles');
            }

            // create and return template
            return $this->render('blog/articles/create.html.twig', [
                'articleForm' => $form->createView()
            ]);


        }

    }

    /**
     * @param Request $request
     * @param ArticleCRUD $articleCRUD
     * @param $id
     * @return Response
     * @Route("blog/article/edit/{id}", name="blog_edit_article")
     */
    public function editArticle( Request $request, ArticleCrud $articleCRUD ,$id)
    {

        //create empty author
        $article = $articleCRUD->getOneById($id);

        //create form
        $form = $this->createForm(
            ArticleFormType::class,
            $article
        );

        //handle form = submit
        $form->handleRequest($request);

        //treat submitted form
        if ($form->isSubmitted() && $form->isValid()) {
            //persit
            $articleCRUD->add($article);

            //redirect
            return $this->redirectToRoute('blog_show_all_articles');
        }

        // create and return template
        return $this->render('blog/articles/update.html.twig', [
            'articleForm' => $form->createView(),
            'article'=> $article
        ]);

    }

    /**
     * @param Request $request
     * @param ArticleCRUD $articleCRUD
     * @param $id
     * @return Response
     * @Route("blog/article/delete/{id}", name="blog_delete_article")
     */
    public function deleteArticle(Request $request, ArticleCrud $articleCRUD , $id)
    {

        //create empty article
        $article = $articleCRUD->getOneById($id);
        $articleCRUD->delete($article);
        //redirect
        return $this->redirectToRoute('blog_show_all_articles');

    }


    /**
     * @param ArticleCRUD $articleCRUD
     * @param $id
     * @return Response
     * @Route("blog/article/{id}", name="blog_show_single_article")
     */
    public function showOneById(ArticleCRUD $articleCRUD, $id)
    {
        /**
         * @var Article $article
         */
        $article = $articleCRUD->getOneById($id);
        return $this->render('blog/articles/one.html.twig',
            ['article' => $article,]);
    }


}
