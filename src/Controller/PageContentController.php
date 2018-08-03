<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PageContentRepository;
use App\Entity\PageContent;

class PageContentController extends AbstractController
{
    /**
     * Rendering main page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main(): Response
    {
        return $this->getPage(PageContent::PAGE_MAIN);
    }

    /**
     * Rendering service page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function service(): Response
    {
        return $this->getPage(PageContent::PAGE_SERVICE);
    }

    /**
     * Rendering contact page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(): Response
    {
        return $this->getPage(PageContent::PAGE_CONTACT);
    }

    /**
     * Universal method for render pages
     * @param $pageName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function getPage($pageName): Response
    {
        $manager = $this->getDoctrine()->getManager();

        /** @var PageContentRepository $repository */
        $repository =  $manager->getRepository(PageContent::class);
        $contents = $repository->findByPageName($pageName);

        return $this->render('pageContent/pageContent.html.twig', [
            'contents' => $contents,
        ]);
    }

}