<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\EvaluationElements;
use App\Entity\User;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evaluateur")
 */
class EvaluateurController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index()
    {
        $data = array();
        $data['user'] = $this->getUser();
        return $this->render('evaluateur/index.html.twig', $data);
    }

    /**
     * @Route("/update", name="update_ev",methods={"POST"})
     */
    public function update(Request $request)
    {

        try {
            $user = $this->getUser();
            $user->setFirstName($request->request->get('firstName'));
            $user->setLastName($request->request->get('lastName'));
            $user->setExperience($request->request->get('experience'));
            $user->setUsername($request->request->get('user_Name'));
            $user->setEmail($request->request->get('email'));
            $user->setPassword($request->request->get('Password'));
            $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $user->setPassword($new_password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->get('session')->getFlashBag()->add(
                'changedProfile',
                'Item Updated Successfully'
            );
        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'changedProfileFalse',
                'Something Went Wrong'
            );
        }
        return $this->render('evaluateur/index.html.twig');
    }

    /**
     * @Route("/critere", name="critere")
     */
    public function critere()
    {
      
        if ($this->getUser()->getEvaluateEntreprise()->getEtapes()[0]==1) {
            $data = array();

        $arr = $this->getUser()->getEvaluateEntreprise()->getId();
        $data['evaluateExpert'] = $this->getUser()->getEvaluateEntreprise();
        $data['entreprise'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $arr], ['name' => 'ASC']);
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\EvaluationElements p
            WHERE p.createur != :id
            AND p.entreprise = :id1
            ORDER BY p.name DESC'
        )->setParameter('id', $this->getUser())->setParameter('id1', $data['entreprise']);

        // returns an array of Product objects
        $value = true;
        $data['evaluations'] = $query->getResult();
        $data['myEvals'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['createur' => $this->getUser()], ['name' => 'ASC']);
        return $this->render('evaluateur/critere.html.twig', $data);
    
        }else
         if($this->getUser()->getRoles()[0] == 'ROLE_EVALUATEUR' )
            return $this->redirectToRoute('profile');
            else
            return $this->redirectToRoute('manager');

        }


    /**
     * @Route("/critereCreate", name="critereCreate",methods={"POST"})
     */
    public function critereCreate(Request $request)
    {

        try {
            if ($request->request->get('parent'))
                $parent = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findOneBy(['id' => $request->request->get('parent')], ['name' => 'ASC']);
            else
                $parent = null;
            $session = new \Symfony\Component\HttpFoundation\Session\Session();
            if ($session->get('project') != null) {
                $entre = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $session->get('project')->getId()], ['name' => 'ASC']);

            }else
                $entre = $this->getUser()->getEvaluateEntreprise();
            $eval = new EvaluationElements();
            $eval->setCreateur($this->getUser());
            $eval->setName($request->request->get('name'));
            $eval->setParent($parent);
            $eval->setEntreprise($entre);
            $eval->setValidate(false);
            $evalnull = $eval->getTeamValidate();
            $newarr = $evalnull;
            array_push($newarr, $this->getUser()->getId());
            $eval->setTeamValidate($newarr);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eval);
            $entityManager->flush();

            $this->get('session')->getFlashBag()->add(
                'addCritere',
                'Criteria Created Successfully'
            );
        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'addCritereFalse',
                    'Something Went Wrong'
            );
        }
        return $this->redirectToRoute('critere');

    }

    /**
     * @Route("/delete/{id}", name="myEvalDelete", methods={"GET"})
     */
    public function delete(Request $request, EvaluationElements $evaluationElement): Response
    {

        try {
            if ($evaluationElement->getCreateur() == $this->getUser()) {
                $child = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['parent' => $evaluationElement], ['name' => 'ASC']);
                foreach ($child as $ch) {
                    $ch->setParent(null);
                    $ch->removeEvaluationElement($evaluationElement);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($ch);
                    $entityManager->flush();
                }
                $evaluationElement->removeEvaluationElement($evaluationElement);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($evaluationElement);
                $entityManager->flush();
                $this->get('session')->getFlashBag()->add(
                    'addCritere',
                    'Item Deleted Successfully'
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                    'addCritere',
                    'Something Went Wrong'
                );
            }
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add(
                'addCritere',
                'Something Went Wrong'
            );
        }


        return $this->redirectToRoute('critere');
    }

    /**
     * @Route("/validation/{id}", name="validation")
     * @return Response
     */
    public function jsonget($id)
    {
        $jsonData = [];
        $critere = $this->getDoctrine()
            ->getRepository(EvaluationElements::class)
            ->find($id);
        $evalnull = $critere->getTeamValidate();
        if (!$evalnull) {
            $arr = array();
            $arr[0] = $this->getUser()->getId();
            $critere->setTeamValidate($arr);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        } else {
            if (in_array($this->getUser()->getId(), $evalnull) == !false) {
                $newarr = $evalnull;
                $key = array_search($this->getUser()->getId(), $newarr);
                unset($newarr[$key]);
                $critere->setTeamValidate($newarr);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            } else {
                $newarr = $evalnull;
                array_push($newarr, $this->getUser()->getId());
                $critere->setTeamValidate($newarr);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            }
        }
        return $this->json($jsonData);

    }



}
