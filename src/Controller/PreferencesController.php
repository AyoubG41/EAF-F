<?php

namespace App\Controller;

use App\Entity\Preferences;
use App\Form\PreferencesType;
use App\Repository\PreferencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/preferences")
 */
class PreferencesController extends AbstractController
{
    /**
     * @Route("/", name="preferences_index", methods={"GET"})
     */
    public function index(PreferencesRepository $preferencesRepository): Response
    {
        return $this->render('preferences/index.html.twig', [
            'preferences' => $preferencesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="preferences_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $preference = new Preferences();
        $form = $this->createForm(PreferencesType::class, $preference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($preference);
            $entityManager->flush();

            return $this->redirectToRoute('preferences_index');
        }

        return $this->render('preferences/new.html.twig', [
            'preference' => $preference,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="preferences_show", methods={"GET"})
     */
    public function show(Preferences $preference): Response
    {
        return $this->render('preferences/show.html.twig', [
            'preference' => $preference,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="preferences_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Preferences $preference): Response
    {
        $form = $this->createForm(PreferencesType::class, $preference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('preferences_index');
        }

        return $this->render('preferences/edit.html.twig', [
            'preference' => $preference,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="preferences_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Preferences $preference): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preference->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($preference);
            $entityManager->flush();
        }

        return $this->redirectToRoute('preferences_index');
    }
}
