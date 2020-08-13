<?php

namespace App\Controller;

use App\Entity\Nanny;
use App\Repository\NannyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NannyController extends AbstractController
{

    /**
     * @var NannyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(NannyRepository $repository,  EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/nourrices", name="nanny.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('nanny/index.html.twig', [
            'current_menu' => 'nannies'
        ]);
    }

    /**
     * @Route("/nourrices/{slug}-{id}", name="nanny.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Nanny $nanny
     * @return Response
     */
    public function show(Nanny $nanny, string $slug): Response
    {
        if ($nanny->getSlug() !== $slug) {
            return $this->redirectToRoute('nanny.show', [
                'id' => $nanny->getId(),
                'slug' => $nanny->getSlug()
            ], 301);
        }
        return $this->render('nanny/show.html.twig', [
            'nanny' => $nanny,
            'current_menu' => 'nannies'
        ]);
    }

}
