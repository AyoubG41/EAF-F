<?php

namespace App\Controller;

use App\Entity\EAF;
use App\Entity\EAFElements;
use App\Entity\Entreprise;
use App\Entity\EvaluationElements;
use App\Entity\Mapping;
use App\Entity\Preferences;
use App\Form\EAFElementsType;
use App\Repository\EAFElementsRepository;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eAF/elements")
 */
class EAFElementsController extends AbstractController
{


    /**
     * @Route("/binaryEvaluation", name="binaireEvaluation", methods={"GET"})
     */
    public function beEvaluation()
    {
        if ($this->getUser()->getExpertEntreprise()->getEtapes()[2]==1) {
            if ($this->getUser()->getRoles()[0] == 'ROLE_EXPERT') {
                $data = array();
                $id = $this->getUser()->getExpertEntreprise();
                $data['entreprise'] =  $this->getUser()->getExpertEntreprise();
                $data['evaluations'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $id,'validate'=>true], ['name' => 'ASC']);


            }else{
                return $this->redirectToRoute('login');
            }


            return $this->render("binaire.html.twig", $data);
        }else
         if($this->getUser()->getRoles()[0] == 'ROLE_EVALUATEUR' )
            return $this->redirectToRoute('profile');
           else
            return $this->redirectToRoute('expert');

        }
    


    /**
     * @Route("/tonewb", name="to_newb", methods={"GET","POST"})
     */
    public function tonewb(Request $request): Response
    {
        if ($request->request->get('id_eaf')) {
            $ent = $this->getDoctrine()
                ->getRepository(EAF::class)
                ->find($request->request->get('id_eaf'));
            $user = $this->getUser();
            if ($request->request->get('id_eafel')) {
                $eval = $this->getDoctrine()
                    ->getRepository(EAFElements::class)
                    ->find($request->request->get('id_eafel'));
                $user = $this->getUser();
                return $this->render('eaf_elements/add.html.twig', [
                    'eaf_element' => $eval,
                    'eaf' => $ent,
                    'user' => $user,
                ]);
            }
            return $this->render('eaf_elements/add.html.twig', [
                'eaf' => $ent,
                'eaf_element' => null,
                'user' => $user,
            ]);
        }

    }

    /**
     * @Route("/addnewb", name="addnewb", methods={"GET","POST"})
     */
    public function addnew(Request $request): Response
    {

        try {
            $ent = $this->getDoctrine()
                ->getRepository(EAF::class)
                ->find($request->request->get('id_eaf'));
            $user = $this->getUser();
            $eval = $this->getDoctrine()
                ->getRepository(EAFElements::class)
                ->find($request->request->get('id_eafel'));
            $evaluationElement = new EAFElements();
            $evaluationElement->setName($request->request->get('name'));
            $evaluationElement->setParent($eval);
            $evaluationElement->setEaf($ent);
            $evaluationElement->setExpert($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluationElement);
            $entityManager->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Item Created Successfully'
            );
            return $this->redirect('/');
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Unknown Error'
            );
            return $this->redirect('/');
        }


    }

    /**
     * @Route("/addnewmap", name="addnewmap", methods={"GET","POST"})
     */
    public function addnewmap(Request $request): Response
    {
        try {
            $query = $this->getDoctrine()->getManager();
            $res = $query->createQuery('SELECT p FROM App\Entity\Mapping p WHERE ( p.EAFElement = :id1 and p.EvaluationElement = :id2 ) ')->setParameter('id1', $request->request->get('eafId'))->setParameter('id2', $request->request->get('evalId'))->getResult();
            if (empty($res[0])) {

                $eval = $this->getDoctrine()
                    ->getRepository(EvaluationElements::class)
                    ->find($request->request->get('evalId'));

                $eaf = $this->getDoctrine()
                    ->getRepository(EAFElements::class)
                    ->find($request->request->get('eafId'));
                $value = $request->request->get('value');
                $user = $this->getUser();
                $mapping = new Mapping();

                $mapping->setValue($value);
                $mapping->setExpert($user);
                $mapping->setEAFElement($eaf);
                $mapping->setEvaluationElement($eval);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($mapping);
                $entityManager->flush();
            } else {
                $value = $request->request->get('value');
                $res[0]->setValue($value);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($res[0]);
                $entityManager->flush();
            }

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Le Mapping et ajouter avec succes'
            );
            return $this->redirect('/');

        } catch (IniSizeFileException $e) {
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Unknown Error'
            );
            return $this->redirect('/');
        }

    }

    /**
     * @Route("/jsonget1/{id}", name="jsonget1")
     * @return Response
     */
    public function jsonget1($id): Response
    {
        $jsonData = [];
        $eaf = $this->getDoctrine()
            ->getRepository(EAF::class)
            ->find($id);
        $evalnull = $eaf->getEAFElementsNull();
        if ($evalnull) {
            foreach ($evalnull as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'eaf' => $c->getEaf()->getId(),
                    'id' => $c->getId()));
            }
            return $this->json($jsonData);
        }
    }

    /**
     * @Route("/evalget1/{id}", name="evalget1")
     * @return Response
     */
    public function evalget1($id): Response
    {

        $jsonData = [];
        $elem = $this->getDoctrine()
            ->getRepository(EAFElements::class)
            ->find($id);
        $evalnull = $elem->getChilds();

        if ($evalnull) {
            foreach ($evalnull as $c) {
                array_push($jsonData, array(
                    'name' => $c->getName(),
                    'id' => $c->getId(),
                    'eaf' => $c->getEaf()->getId(),
                    'parentName' => $c->getParent()->getName(),
                    'parent' => $c->getParent()->getId()));
            }
            return $this->json($jsonData);
        }

    }


    /**
     * @Route("/hil/{id}", name="hil")
     * @return Response
     */
    public function evalget8($id): Response
    {

        $jsonData = [];
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT p.name
            FROM App\Entity\EAF p
            WHERE p.id > :id
            ORDER BY p.name ASC'
        )->setParameter('id', $id)->getResult();

        dd($query);

        return $this->json($query);


    }


}
