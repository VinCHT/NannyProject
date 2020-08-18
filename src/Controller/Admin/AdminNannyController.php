<?php

namespace App\Controller\Admin;

use App\Entity\Nanny;
use App\Form\NannyType;
use App\Repository\NannyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNannyController extends AbstractController
{

    /**
     * @var NannyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(NannyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.nanny.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $nannies = $this->repository->findAll();
        return $this->render('admin/nanny/index.html.twig', compact('nannies'));
    }

    /**
     * @Route("/admin/nanny/create", name="admin.nanny.new")
     */
    public function new(Request $request)
    {
        $nanny = new Nanny();
        $form = $this->createForm(NannyType::class, $nanny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($nanny);
            $this->em->flush();
            $this->addFlash('success', 'Profil créé avec succès');
            return $this->redirectToRoute('admin.nanny.index');
        }

        return $this->render('admin/nanny/new.html.twig', [
            'nanny' => $nanny,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/nanny/{id}", name="admin.nanny.edit", methods="GET|POST")
     * @param Nanny $nanny
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Nanny $nanny, Request $request)
    {
        $form = $this->createForm(NannyType::class, $nanny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Profil modifié avec succès');
            return $this->redirectToRoute('admin.nanny.index');
        }

        return $this->render('admin/nanny/edit.html.twig', [
            'nanny' => $nanny,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/nanny/{id}", name="admin.nanny.delete", methods="DELETE")
     * @param Nanny $nanny
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Nanny $nanny, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $nanny->getId(), $request->get('_token'))) {
            $this->em->remove($nanny);
            $this->em->flush();
            $this->addFlash('success', 'Profil supprimé avec succès');
        }
        return $this->redirectToRoute('admin.nanny.index');
    }

}
