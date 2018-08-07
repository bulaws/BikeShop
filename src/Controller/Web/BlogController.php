<?php

namespace App\Controller\Web;

use App\Traits\ArticleTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;


class BlogController extends AbstractController
{
    use ArticleTrait;

    /**
     * Rendering index page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() : Response
    {
        $articles = $this->getArticles();

        return $this->render("blog/blog.html.twig", [
                  'articles' => $articles,
               ]);
    }

    /**
     * Rendering article page
     *
     * @param Article $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle(Article $id) : Response
    {
        $article = $this->getArticle($id);;

        if(!$article) {
           throw $this->createNotFoundException();
        }
        return $this->render("blog/article.html.twig", [
                   'article' => $article,
               ]);
    }
}