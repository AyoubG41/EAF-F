<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\EAF;
use App\Entity\EAFElements;
use App\Entity\Entreprise;
use App\Entity\EvaluationElements;
use App\Entity\User;
use App\Form\EvaluationElementsType;
use App\Repository\EvaluationElementsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Schema\AbstractAsset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evaluation/elements")
 */
class EvaluationElementsController extends AbstractController
{
    /**
     * @Route("/", name="evaluation_elements_index", methods={"GET"})
     */
    public function index(EvaluationElementsRepository $evaluationElementsRepository): Response
    {
        return $this->render('evaluation_elements/index.html.twig', [
            'evaluation_elements' => $evaluationElementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evaluation_elements_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evaluationElement = new EvaluationElements();
        $form = $this->createForm(EvaluationElementsType::class, $evaluationElement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluationElement);
            $entityManager->flush();

            return $this->redirectToRoute('evaluation_elements_index');
        }
        return $this->render('evaluation_elements/new.html.twig', [
            'evaluation_element' => $evaluationElement,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="evaluation_elements_show", methods={"GET"})
     */
    public function show(EvaluationElements $evaluationElement): Response
    {
        return $this->render('evaluation_elements/show.html.twig', [
            'evaluation_element' => $evaluationElement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evaluation_elements_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EvaluationElements $evaluationElement): Response
    {
        $form = $this->createForm(EvaluationElementsType::class, $evaluationElement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('evaluation_elements_index');
        }
        return $this->render('evaluation_elements/edit.html.twig', [
            'evaluation_element' => $evaluationElement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evaluation_elements_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EvaluationElements $evaluationElement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $evaluationElement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evaluationElement);
            $entityManager->flush();
        }
        return $this->redirectToRoute('evaluation_elements_index');
    }

    /**
     * @Route("/tonew", name="to_new", methods={"post"})
     */
    public function tonew(Request $request): Response
    {
        if ($request->request->get('id_ent')) {
            $ent = $this->getDoctrine()
                ->getRepository(Entreprise::class)
                ->find($request->request->get('id_ent'));
            if ($request->request->get('id_eval')) {
                $eval = $this->getDoctrine()
                    ->getRepository(EvaluationElements::class)
                    ->find($request->request->get('id_eval'));
                return $this->render('evaluation_elements/add.html.twig', [
                    'evaluation_element' => $eval,
                    'entreprise' => $ent,
                ]);
            }
            return $this->render('evaluation_elements/add.html.twig', [
                'entreprise' => $ent,
                'evaluation_element' => null,
            ]);
        }
    }

//    /**
//     * @Route("/addnew", name="addnew", methods={"GET","POST"})
//     */
//    public function addnew(Request $request): Response
//    {
//
//        try {
//            $ent = $this->getDoctrine()
//                ->getRepository(Entreprise::class)
//                ->find($request->request->get('entreprise'));
//            $eval = $this->getDoctrine()
//                ->getRepository(EvaluationElements::class)
//                ->find($request->request->get('parent'));
//            $evaluationElement = new EvaluationElements();
//            $evaluationElement->setName($request->request->get('name'));
//            $evaluationElement->setEntreprise($ent);
//            $evaluationElement->setParent($eval);
//            $evaluationElement->setValidate(false);
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($evaluationElement);
//            $entityManager->flush();
//            $this->get('session')->getFlashBag()->add(
//                'notice',
//                'L\'element  et ajouter avec succes');
//            return $this->redirect('/');
//        } catch (\Exception $e) {
//            $this->get('session')->getFlashBag()->add(
//                'notice',
//                'Uknown Error');
//            return $this->redirect('/');
//        }
//
//    }

    /**
     * @Route("/jsonget/{id}", name="jsongetjsonget")
     * @return Response
     */
    public function jsonget($id): Response
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $user = $this->getUser();
        if ($user->getRoles()[0]=='ROLE_MANAGER'){

            if ($session->get('project') == null) {
                return $this->redirectToRoute('entreprise_index');
            }else{
                $entreprise = $this->getDoctrine()
                    ->getRepository(Entreprise::class)
                    ->find($session->get('project')->getId());
            }
        }else{
           $entreprise= $this->getDoctrine()
               ->getRepository(Entreprise::class)
               ->find($user->getEvaluateEntreprise()->getId());
        }
        $jsonData = [];
        $evalnull = $entreprise->getEvaluationElementsNullByUser($user);
        if ($evalnull) {
            foreach ($evalnull as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'entreprise' => $c->getEntreprise()->getId(),
                    'id' => $c->getId()));
            }
            return $this->json($jsonData);
        }
    }


    /**
     * @Route("/evalget/{id}", name="evalget")
     * @return Response
     */
    public function evalget($id): Response
    {
        $jsonData = [];
        $eval = $this->getDoctrine()
            ->getRepository(EvaluationElements::class)
            ->find($id);
        $evalnull = $eval->getEvaluationElements();

        if ($evalnull) {
            foreach ($evalnull as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'id' => $c->getId(),
                    'entreprise' => $c->getEntreprise()->getId(),
                    'parentName' => $c->getParent()->getName(),
                    'parent' => $c->getParent()->getId()));
            }
            return $this->json($jsonData);
        }

    }

    /**
     * @Route("/jsongetAll/{id}", name="jsongetAll")
     * @return Response
     */
    public function jsongetAll($id): Response
    {
        $jsonData = [];
        $entreprise = $this->getDoctrine()
            ->getRepository(Entreprise::class)
            ->find($id);
        $evalnull = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['validate' => true, 'entreprise' => $entreprise], ['name' => 'ASC']);
        if ($evalnull) {
            foreach ($evalnull as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'entreprise' => $c->getEntreprise()->getId(),
                    'id' => $c->getId()));
            }
            return $this->json($jsonData);
        } else {

            return $this->json('no element found');

        }
    }


    /**
     * @Route("/jsongetAllB/{id}", name="jsongetAllB")
     * @return Response
     */
    public function jsongetAllB($id): Response
    {
        if ($this->getUser()->getExpertEntreprise() == !null) {

            $entr = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $this->getUser()->getExpertEntreprise()->getId()]);

            $jsonData = [];
            $entreprise = $this->getDoctrine()
                ->getRepository(EvaluationElements::class)
                ->find($id);
            $evals = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $entr, 'evaluationElement' => $entreprise], ['name' => 'ASC']);


            if ($evals) {
                foreach ($evals as $c) {
                    array_push($jsonData, array(
                        'name' => $c->getName(),
                        'entreprise' => $c->getEntreprise()->getId(),
                        'id' => $c->getId()));
                }
                return $this->json($jsonData);
            }
        }
    }


    /**
     * @Route("/jsongetAllByUser/{id}", name="jsongetAllByUser")
     * @return Response
     */
    public function jsongetAllByUser($id): Response
    {
        $jsonData = [];
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        $entreprise = $user->getEvaluateEntreprise();
        if ($entreprise = !null) {
            $evalnull = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['validate' => true, 'entreprise' => $entreprise], ['name' => 'ASC']);
            if ($evalnull) {
                foreach ($evalnull as $c) {
                    array_push($jsonData, array(
                        'name' => $c->getName(),
                        'entreprise' => $c->getEntreprise()->getId(),
                        'id' => $c->getId()));
                }
                return $this->json($jsonData);
            } else {

                return $this->json('no element found');

            }
        }

    }

    /**
     * @Route("/jsongetAllBbyUser/{id}/{ev}", name="jsongetAllBbyUser")
     * @return Response
     */
    public function jsongetAllBbyUser($id,$ev): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        $entreprise=$user->getExpertEntreprise();
        $jsonData = [];
        $criteria = $this->getDoctrine()
            ->getRepository(EvaluationElements::class)
            ->find($ev);
        $evals = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $entreprise, 'evaluationElement' => $criteria], ['name' => 'ASC']);


        if ($evals) {
            foreach ($evals as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'entreprise' => $c->getEntreprise()->getId(),
                    'id' => $c->getId()));
            }
            return $this->json($jsonData);
        }
    }


}

