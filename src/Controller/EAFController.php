<?php

namespace App\Controller;

use App\Entity\EAF;
use App\Form\EAFType;
use App\Repository\EAFRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/e/a/f")
 */
class EAFController extends AbstractController
{
    /**
     * @Route("/", name="e_a_f_index", methods={"GET"})
     * @param EAFRepository $eAFRepository
     * @return Response
     */
    public function index(EAFRepository $eAFRepository): Response
    {
        if($this->getUser()->getRoles()[0]=='ROLE_EXPERT'){
            return $this->render('eaf/index.html.twig', [
                'e_a_fs' => $eAFRepository->findBy(
                    ['createur'=>$this->getUser()],
                    ['name' => 'ASC']
                ),
            ]);
        }else{
            return $this->render('eaf/index.html.twig', [
                'e_a_fs' => $eAFRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/new", name="e_a_f_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eAF = new EAF();
        $form = $this->createForm(EAFType::class, $eAF);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eAF->setCreateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eAF);
            $entityManager->flush();

            return $this->redirectToRoute('e_a_f_index');
        }

        return $this->render('eaf/new.html.twig', [
            'e_a_f' => $eAF,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="e_a_f_show", methods={"GET"})
     */
    public function show(EAF $eAF): Response
    {
        return $this->render('eaf/show.html.twig', [
            'e_a_f' => $eAF,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="e_a_f_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EAF $eAF): Response
    {
        $form = $this->createForm(EAFType::class, $eAF);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('e_a_f_index');
        }

        return $this->render('eaf/edit.html.twig', [
            'e_a_f' => $eAF,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="e_a_f_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EAF $eAF): Response
    {

        if ($this->isCsrfTokenValid('delete'.$eAF->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eAF);
            $entityManager->flush();
        }

        return $this->redirectToRoute('e_a_f_index');
    }
}
