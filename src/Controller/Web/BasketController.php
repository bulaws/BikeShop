<?php

namespace App\Controller\Web;

use App\Service\Basket\BasketList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class BasketController extends AbstractController
{
    public function index(SessionInterface $session, BasketList $list): Response
    {
        $basket = $session->get('basketProducts');
        $basketList = $list->BasketList($basket, $this->getDoctrine());

        return $this->render("basket/basket.html.twig", [
            'basketList' => $basketList
        ]);
    }

    /**
     * @param $id
     * @param SessionInterface $session
     * @return Response
     */
    public function addToBasket($id, SessionInterface $session): Response
    {
        $basket = $session->get('basketProducts');
        if (empty($basket)) {
            $basket = [];
        }
        $basket[$id] = $id;
        $session->set('basketProducts', $basket);

        return $this->redirectToRoute('products');
    }

    /**
     * @param $id
     * @param SessionInterface $session
     * @return Response
     */
    public function deleteFromBasket($id, SessionInterface $session): Response
    {
        $basket = $session->get('basketProducts');
        if (isset($basket[$id])) {
            unset($basket[$id]);
        }
        $session->set('basketProducts', $basket);

        return $this->redirectToRoute('basket');
    }

}