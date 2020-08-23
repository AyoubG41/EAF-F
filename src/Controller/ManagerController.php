<?php

namespace App\Controller;

use App\Entity\BinaireEvaluation;
use App\Entity\EAF;
use App\Entity\Entreprise;
use App\Entity\Etape;
use App\Entity\EvaluationElements;
use App\Entity\Preferences;
use App\Entity\User;
use MongoDB\Driver\Session;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
    /**
     * @Route("/manager")
     */
{
    /**
     * @Route("/", name="manager")
     */
    public function index()
    {

        $data = array();

        $data['evaluations'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['parent' => null],
            ['name' => 'ASC']);

        $data['managerEntreprise'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(['manager' => $this->getUser()],
            ['name' => 'ASC']);
        return $this->render('manager/index.html.twig', $data);
    }

    /**
     * @Route("/generate_evaluateures", name="generate_evaluateures",methods={"GET","POST"})
     */
    public function generate_evaluateures(Request $request)
    {

        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == null) {
            return $this->redirectToRoute('entreprise_index');
        }
        if ($request->request->get('firstname') == !null) {
            try {
                $test = $session->get('project');
                $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()],
                    ['name' => 'ASC']);
                $user = new User();
                $user->setEnabled(true);
                $user->setFirstName($request->request->get('firstname'));
                $user->setLastName($request->request->get('lastname'));
                $user->setExperience($request->request->get('experience'));
                $user->setUsername($request->request->get('username'));
                $user->setDomain($request->request->get('domain'));
                $user->setEmail($request->request->get('email'));
                $user->setPassword($request->request->get('password'));
                $user->setGeneratedBy($this->getUser()->getId());
                $user->setRoles(['ROLE_EVALUATEUR']);
                $user->setEvaluateEntreprise($entreprise);
                $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($new_password);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'User Created Successfully'
                );
            } catch (\Exception $e) {

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'Something Went Wrong'
                );
            }
        }
        $data = array();

        $jsonData = [];
        $data['users'] = [];
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $test = $session->get('project');
        $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()],
            ['name' => 'ASC']);
        $jsonData = $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(['evaluateEntreprise' => $entreprise, 'generated_by' => $this->getUser()],
            ['username' => 'ASC']);
        array_push($data['users'], $jsonData);


        return $this->render('manager/evaluateures.html.twig', $data);
    }


    /**
     * @Route("/generate_experts", name="generate_experts",methods={"GET","POST"})
     */
    public function generate_experts(Request $request)
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == null) {
            return $this->redirectToRoute('entreprise_index');
        }
        if ($request->request->get('firstname') == !null) {
            try {

                $test = $session->get('project');
                $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()],
                    ['name' => 'ASC']);


                $user = new User();
                $user->setEnabled(true);
                $user->setFirstName($request->request->get('firstname'));
                $user->setLastName($request->request->get('lastname'));
                $user->setExperience($request->request->get('experience'));
                $user->setUsername($request->request->get('username'));
                $user->setEmail($request->request->get('email'));
                $user->setPassword($request->request->get('password'));
                $user->setDomain($request->request->get('domain'));
                $user->setGeneratedBy($this->getUser()->getId());
                $user->setRoles(['ROLE_EXPERT']);
                $user->setExpertEntreprise($entreprise);
                $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($new_password);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'User Created Successfully'
                );
            } catch (\Exception $e) {

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'Something Went Wrong'
                );
            }
        }
        $data = array();

        $jsonData = [];
        $data['users'] = [];
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $test = $session->get('project');
        $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()],
            ['name' => 'ASC']);
        $jsonData = $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(['expertEntreprise' => $entreprise, 'generated_by' => $this->getUser()],
            ['username' => 'ASC']);
        array_push($data['users'], $jsonData);


        return $this->render('manager/experts.html.twig', $data);
    }


    /**
     * @Route("/jsonget/{id}", name="jsonget")
     * @return Response
     */
    public function jsonget($id): Response
    {
        $jsonData = [];
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == !null) {
            $test = $session->get('project');
            $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()], ['name' => 'ASC']);

            $evalnull = $entreprise->getEvaluateures();
            if ($evalnull) {
                foreach ($evalnull as $c) {
                    array_push($jsonData, array(
                        'name' => $c->getUsername(),
                        'id' => $c->getId()));
                }
                return $this->json($jsonData);
            }
        } else
            $this->redirectToRoute('entreprise_index');
        return $this->json('no data found');


    }

    /**
     * @Route("/jsonget2/{id}", name="jsonget2")
     * @return Response
     */
    public function jsonget2($id): Response
    {

        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == !null) {
            $jsonData = [];
            $data = [];
            $test = $session->get('project');
            $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()], ['name' => 'ASC']);
            $evalnull = $entreprise->getEvaluationElements();

            if ($evalnull) {
                $evaluateures = $entreprise->getEvaluateures();

                foreach ($evalnull as $c) {
                    foreach ($evaluateures as $ev) {

                        if ($c->getTeamValidate() == null) {
                            array_push($data, array(
                                'name' => 'no'));
                        } else {
                            if (in_array($ev->getId(), $c->getTeamValidate())) {

                                array_push($data, array(
                                    'name' => 'yes'));

                            } else {
                                array_push($data, array(
                                    'name' => 'no'));
                            }
                        }

                    }
                    if ($c->getParent()) {
                        $parent = $c->getParent()->getName();
                    } else {
                        $parent = 'null';
                    }
                    array_push($jsonData, array(
                        'name' => $c->getName(),
                        'createur' => $c->getCreateur()->getUsername(),
                        'id' => $c->getId(),
                        'parent' => $parent,
                        'valMain' => $c->getValidate(),
                        'validee' => $data));
                    $data = [];

                }

                return $this->json($jsonData);
            }
        }

    }


    /**
     * @Route("/validate/{id}", name="validate")
     * @return Response
     */
    public function validate($id): Response
    {
        $jsonData = [];
        $critere = $this->getDoctrine()
            ->getRepository(EvaluationElements::class)
            ->find($id);
        $critere->setValidate(!$critere->getValidate());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->json($jsonData);

    }


    
    /**
     * @Route("/etape/{id}", name="etape")
     * @return Response
     */
    public function etape($id): Response
    {
        $jsonData = [];
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == !null) {
            $test = $session->get('project');
            $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()], ['name' => 'ASC']);
            $etapes=[];
            $etapes=$entreprise->getEtapes();
            if($etapes[$id-1]=='0'){
                $etapes[$id-1]='1';
            }else{
                $etapes[$id-1]='0';
            }
         
          
            $entreprise->setEtapes( $jsonData);
            $entreprise->setEtapes($etapes);
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->flush();
         
        }else{
            return $this->json('something went wrong');
        }
       
   
       


      
        return $this->json($jsonData);

    }

    /**
     * @Route("/expert/erase/{id}", name="delete_experts",methods={"GET"})
     */
    public function delete_experts($id)
    {
        $int = (int)$id;
        $connected_user = $this->getUser();
        $delete_user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id' => $int]);
        if ($delete_user->getGeneratedBy() == $connected_user->getId() && $delete_user->getExpertEntreprise() == !null) {
            try {
                $child = $this->getDoctrine()->getManager()->getRepository(BinaireEvaluation::class)->findBy(['createur' => $delete_user]);
                foreach ($child as $ch) {
                    $delete_user->removeBinaireEvaluation($ch);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($delete_user);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'User Deleted Successfully'
                );
            } catch (\Exception $e) {

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'Something Went Wrong'
                );
            }

            return $this->redirectToRoute('generate_experts');
        }
    }


    /**
     * @Route("/evaluateur/erase/{id}", name="delete_evaluateur",methods={"GET"})
     */
    public function delete_evaluateur($id)
    {
        $int = (int)$id;
        $connected_user = $this->getUser();
        $delete_user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id' => $int]);
        if ($delete_user->getGeneratedBy() == $connected_user->getId() && $delete_user->getEvaluateEntreprise() == !null) {
            try {
                $child = $this->getDoctrine()->getManager()->getRepository(Preferences::class)->findBy(['evaluateur' => $delete_user]);
                foreach ($child as $ch) {
                    $delete_user->removePreference($ch);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();
                }
                $childTwo = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['createur' => $delete_user]);
                foreach ($childTwo as $ch) {
                    $delete_user->removeEvaluationElement($ch);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($delete_user);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'User Deleted Successfully'
                );
            } catch (\Exception $e) {

                $this->get('session')->getFlashBag()->add(
                    'evaluateures',
                    'Something Went Wrong'
                );
            }

            return $this->redirectToRoute('generate_evaluateures');
        }
    }



//    /**
//     * @Route("/etape/", name="etape")
//     * @return Response
//     */
//    public function etape(): Response
//    {
//        $jsonData = [];
//        if (!$this->getDoctrine()->getManager()->getRepository(Etape::class)->findOneBy(['manager' => $this->getUser()])){
//            $etape=new Etape();
//            $etape->setManager($this->getUser());
//            $etape->setValue(true);
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($etape);
//            $entityManager->flush();
//            array_push($jsonData, array(
//                'value' => true));
//        }else{
//            $etap=$this->getDoctrine()->getManager()->getRepository(Etape::class)->findOneBy(['manager' => $this->getUser()]);
//            $etap->setValue(!($etap->getValue()));
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->flush();
//            array_push($jsonData, array(
//                'value' => $etap->getValue()));
//        }
//
//
//        return $this->json($jsonData);
//
//    }

    /**
     * @Route("/alternative", name="alternative")
     */
    public function alternative()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == null) {
            return $this->redirectToRoute('entreprise_index');
        }
        $data = array();
        $test = $session->get('project');
        $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()]);
        $data['myEvals'] = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['createur' => $this->getUser(), 'entreprise' => $entreprise], ['evaluationElement' => 'ASC']);
        $data['critarias'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $entreprise, 'validate' => true], ['name' => 'ASC']);
        return $this->render('manager/alternative.html.twig', $data);
    }

    /**
     * @Route("/alternative_create", name="alternative_create",methods={"POST"})
     */
    public function alternative_create(Request $request)
    {
        try {
            $session = new \Symfony\Component\HttpFoundation\Session\Session();
            if ($session->get('project') == null) {
                return $this->redirectToRoute('entreprise_index');
            }
            $element = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findOneBy(['id' => $request->request->get('criteria')], ['name' => 'ASC']);
            $eval = new EAF();
            $eval->setCreateur($this->getUser());
            $eval->setName($request->request->get('name'));
            $eval->setEvaluationElement($element);

            $test = $session->get('project');
            $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $test->getId()]);
            $eval->setVersion($request->request->get('version'));
            $eval->setEntreprise($entreprise);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eval);
            $entityManager->flush();

            $this->get('session')->getFlashBag()->add(
                'addCritere',
                'Alternative Created successfully'
            );
        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'addCritereFalse',
                'Something Went Wrong'
            );
        }
        return $this->redirectToRoute('alternative');

    }

    /**
     * @Route("/alternative/{id}", name="alternative_delete", methods={"GET"})
     */
    public function delete(Request $request, EAF $eAF): Response
    {

        try {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eAF);
            $entityManager->flush();
            $this->get('session')->getFlashBag()->add(
                'addCritere',
                'Alternative Deleted successfully'
            );

        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'addCritereFalse',
                'Something Went Wrong'
            );
        }
        return $this->redirectToRoute('alternative');

    }


    /**
     * @Route("/toNextStep/{id}", name="toNextStep", methods={"post"})
     */
    public function toNextStep(Request $request, $id): Response
    {
        $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $request->request->get('project')]);

        if ($id == 'A') {
            $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $request->request->get('project')]);
            $session = new \Symfony\Component\HttpFoundation\Session\Session();

            $session->set('project', $entreprise);
            return $this->redirectToRoute('generate_evaluateures');
        } elseif ($id == 'B') {
            if ($request->request->get('checking') == "on") {
                $this->getUser()->addRole('ROLE_EVALUATEUR');
                $session = new \Symfony\Component\HttpFoundation\Session\Session();
                $entreprise = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $session->get('project')->getId()]);
                $this->getUser()->setEvaluateEntreprise($entreprise);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('critere');
            } else {
                $this->getUser()->removeRole('ROLE_EVALUATEUR');
                $this->getUser()->setEvaluateEntreprise(null);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('manager');
            }
        }
    }

    /**
     * @Route("/preferences", name="manager_prefernces")
     */
    public function preferences()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == null) {
            return $this->redirectToRoute('entreprise_index');
        }
        $entreprise = $session->get('project');
        $data = array();
        $data['users'] = $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(['evaluateEntreprise' => $entreprise, 'generated_by' => $this->getUser()->getId()], ['id' => 'ASC']);

        return $this->render('manager/preferences.html.twig', $data);
    }

    /**
     * @Route("/binary_preferences", name="manager_binary_prefernces")
     */
    public function binary_preferences()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        if ($session->get('project') == null) {
            return $this->redirectToRoute('entreprise_index');
        }
        $entreprise = $session->get('project');
        $data = array();
        $data['users'] = $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(['expertEntreprise' => $entreprise, 'generated_by' => $this->getUser()->getId()], ['id' => 'ASC']);
        $data['alternatives'] = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $entreprise], ['id' => 'ASC']);
        $data['ctiterias'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $entreprise, 'validate' => true], ['id' => 'ASC']);

        return $this->render('manager/binary_preferences.html.twig', $data);
    }
}
