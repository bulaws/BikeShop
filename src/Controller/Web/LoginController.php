<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('security/login.html.twig', [
        ]);
    }

    public function logoutAction()
    {
        throw new \RuntimeException('Logout');
    }
}