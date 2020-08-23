<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="entreprise_index", methods={"GET"})
     */
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {

        if ($this->getUser()->getRoles()[0] == 'ROLE_MANAGER') {
            return $this->render('entreprise/index.html.twig', [
                'entreprises' => $entrepriseRepository->findBy(
                    ['manager' => $this->getUser()],
                    ['name' => 'ASC']
                ),
            ]);
        } else {
            return $this->render('entreprise/index.html.twig', [
                'entreprises' => $entrepriseRepository->findAll(),
            ]);
        }

    }

    /**
     * @Route("/new", name="entreprise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);
        $entreprise->setManager($this->getUser());
        if ($form->isSubmitted() && $form->isValid()) {
            $arr = [0, 0, 0];
            $entreprise->setEtapes($arr);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_show", methods={"GET"})
     */
    public function show(Entreprise $entreprise): Response
    {
        if ($this->getUser()->getRoles()[0] == 'ROLE_MANAGER') {
            if ($entreprise->getManager() == $this->getUser()) {

                return $this->render('entreprise/show.html.twig', [
                    'entreprise' => $entreprise,
                ]);
            } else {
                return $this->render('entreprise/index.html.twig', [
                    'entreprises' => $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(
                        ['manager' => $this->getUser()],
                        ['name' => 'ASC']
                    ),
                ]);
            }
        }
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entreprise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entreprise $entreprise): Response
    {

        if ($this->getUser()->getRoles()[0] == 'ROLE_MANAGER') {
            if ($entreprise->getManager() == $this->getUser()) {
                $form = $this->createForm(EntrepriseType::class, $entreprise);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute('entreprise_index');
                }

                return $this->render('entreprise/edit.html.twig', [
                    'entreprise' => $entreprise,
                    'form' => $form->createView(),
                ]);

            } else {
                return $this->render('entreprise/index.html.twig', [
                    'entreprises' => $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(
                        ['manager' => $this->getUser()],
                        ['name' => 'ASC']
                    ),
                ]);
            }
        }
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entreprise $entreprise): Response
    {
        if ($this->getUser()->getRoles()[0] == 'ROLE_MANAGER') {
            if ($entreprise->getManager() == $this->getUser()) {
                if ($this->isCsrfTokenValid('delete' . $entreprise->getId(), $request->request->get('_token'))) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($entreprise);
                    $entityManager->flush();
                }

                return $this->redirectToRoute('entreprise_index');
            } else {
                return $this->render('entreprise/index.html.twig', [
                    'entreprises' => $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(
                        ['manager' => $this->getUser()],
                        ['name' => 'ASC']
                    ),
                ]);
            }
        }

        if ($this->isCsrfTokenValid('delete' . $entreprise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entreprise_index');
    }
}
