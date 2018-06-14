<?php

namespace App\Controller;

use App\Logger\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends Controller
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        dump($this->logger->log('hello'));

        return $this->render('homepage/index.html.twig');
    }
}
