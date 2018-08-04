<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;
use App\Form\ArticleType;

class BlogController extends AbstractController
{
    /**
     * Rendering index page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)->findAll();

        return $this->render("blog/blog.html.twig", [
            'articles' => $articles,
        ]);
    }

    /**
     * Rendering article page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle($id) : Response
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)->find($id);

        if(!$article) {
            return $this->render("blog/article.html.twig", [
                'article' => null,
                'articleId' => $id,
            ]);
        }
        return $this->render("blog/article.html.twig", [
            'article' => $article,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createArticle(Request $request,Article $article)
    {
        $form = $this->createForm(ArticleType::class,  $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                /** @var $newArticle Article */
            $newArticle = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newArticle);
            $em->flush();
            return $this->redirectToRoute('blog');
        }
        return $this->render('blog/createArticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateArticle(Request $request,Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('blog');
        }
        return $this->render('blog/updateArticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteArticle(Article $article)
    {
        if ($article === null) {
            return $this->redirectToRoute('blog');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('blog');
    }
}