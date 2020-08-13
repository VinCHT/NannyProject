<?php

namespace App\Controller;

use App\Repository\NannyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param NannyRepository $repository
     * @return Response
     */
    public function index(NannyRepository $repository): Response
    {
        $nannies = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'nannies' => $nannies
        ]);
    }

}