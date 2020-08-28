<?php

namespace App\Controller;

use App\Entity\Nanny;

use App\Entity\NannySearch;
use App\Form\NannySearchType;
use App\Repository\NannyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /*Fonction pour gérer la pagination des nourrices*/
    /**
     * @Route("/nourrices", name="nanny.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new NannySearch();
        $form = $this->createForm(NannySearchType::class, $search);
        $form->handleRequest($request);

        $nannies = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page',1),
            12
        );
        return $this->render('nanny/index.html.twig', [
            'current_menu' => 'nannies',
            'nannies' => $nannies,
            'form' => $form->createView()
        ]);
    }
    /*Fonction pour montrer un profil cible*/
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
