<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use App\Entity\Article;

class BlogController extends FOSRestController
{
    /**
     * Get one article from db
     *
     * @param  $id
     * @return View
     *
     * @Rest\Get("/article/{id}")
     */
    public function getArticle(int $id): View
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneById($id);

        if (empty($article)) {
            throw $this->createNotFoundException(sprintf('This article with id "%d" not found!', $id));
        }

        return $this->view($article, Response::HTTP_OK);
    }

    /**
     * Get all articles from db
     *
     * @return View
     *
     * @Rest\Get("/articles")
     */

    public function getAllArticle(): View
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->view($articles, Response::HTTP_OK);
    }

    /**
     * Post new article in db
     *
     * @param $request
     * @return View
     *
     * @Rest\Post("/article")
     */

    public function createArticle(Request $request)
    {
        $post = $request->request;

        $article = new Article();

        $article->setName($post->get('name'));
        $article->setText($post->get('text'));
        $article->setAuthor($post->get('author'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->view($article, Response::HTTP_CREATED);
    }

    /**
     * Update article
     *
     * @param $request
     * @param $id
     * @return View
     *
     * @Rest\Patch("/article/{id}")
     */
    public function patchArticle(int $id, Request $request): View
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneById($id);

        if (empty($article)) {
            throw $this->createNotFoundException(sprintf('This article with id "%d" not found!', $id));
        }

        $post = $request->request;
        $article->setName($post->get('name'));
        $article->setText($post->get('text'));
        $article->setAuthor($post->get('author'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->view($article, Response::HTTP_OK);
    }

    /**
     * Delete article from db
     *
     * @param int $id
     * @return View
     *
     * @Rest\Delete("/article/{id}")
     */

    public function deleteArticle(int $id): View
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneById($id);

        if (empty($article)) {
            throw $this->createNotFoundException(sprintf('This article with id "%d" not found!', $id));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->view([],Response::HTTP_NO_CONTENT);
    }

}