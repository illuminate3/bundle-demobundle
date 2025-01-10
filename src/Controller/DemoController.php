<?php

namespace App\Bundles\DemoBundle\src\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/test', name: 'demo_test')]
    public function index(): Response
    {
        return $this->render('@DemoBundle/demo/index.html.twig', [
            'message' => 'Demo Bundle is working!'
        ]);
    }
}
