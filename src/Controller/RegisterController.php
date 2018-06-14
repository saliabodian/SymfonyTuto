<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    private $passwordEncoder;
    private $em;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $encodedPassword = $this->passwordEncoder->encodePassword($admin, $admin->getRawPassword());
            $admin->setPassword($encodedPassword);

            $this->em->persist($admin);
            $this->em->flush();

            $this->addFlash('success', 'Thanks for the registration.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
