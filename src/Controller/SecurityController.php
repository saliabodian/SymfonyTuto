<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    private $utils;

    public function __construct(AuthenticationUtils $utils)
    {
        $this->utils = $utils;
    }

    /**
     * @Route("/login", name="login", methods={"GET"})
     */
    public function login()
    {
        return $this->render('security/login.html.twig', [
            'error' => $this->utils->getLastAuthenticationError(),
            'last_username' => $this->utils->getLastUsername(),
        ]);
    }

    /**
     * @Route("/login-check", name="login_check", methods={"POST"})
     */
    public function loginCheck()
    {
        throw new \BadMethodCallException("The security component should handle this route.");
    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \BadMethodCallException("The security component should handle this route.");
    }
}
