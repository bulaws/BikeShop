<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
           throw new NotFoundHttpException();
        }
        return $this->render("blog/article.html.twig", [
            'article' => $article,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createArticle(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,  $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                /** @var $newArticle Article */
            $newArticle = $form->getData();
            $newArticle->setUpdateAt();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newArticle);
            $em->flush();
            return $this->redirectToRoute('blog');
        }
        return $this->render('blog/createArticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateArticle(Request $request, Article $article)
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