<?php

namespace App\Controller;

use App\Entity\BinaireEvaluation;
use App\Entity\EAF;
use App\Entity\EAFElements;
use App\Entity\Entreprise;
use App\Entity\EvaluationElements;
use App\Entity\Mapping;
use App\Entity\Preferences;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\PreferencesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;
use phpDocumentor\Reflection\DocBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect('/login');
        }

        $data = array();
        $data['eafs'] = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findAll();
        $data['entreprises'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findAll();


        if ($this->getUser()->getRoles()[0] == 'ROLE_EVALUATEUR') {
            $arr = $this->getUser();
            $entr = $this->getUser()->getEvaluateEntreprise();
            $entityManager = $this->getDoctrine()->getManager();
            $query = $entityManager->createQuery(
                'SELECT p
            FROM App\Entity\EvaluationElements p
            WHERE p.createur != :id
            AND p.entreprise = :id1
            ORDER BY p.name DESC'
            )->setParameter('id', $arr)->setParameter('id1', $entr);
            $querys = $entityManager->createQuery(
                'SELECT p
            FROM App\Entity\EvaluationElements p
            WHERE p.validate = :id
            AND p.entreprise = :id1
            ORDER BY p.name DESC'
            )->setParameter('id', true)->setParameter('id1', $entr);
            // returns an array of Product objects
            $value = true;
            $data['evaluations'] = $query->getResult();
            $data['validateCritarias'] = $querys->getResult();
            $data['evaluateExpert'] = $this->getUser()->getEvaluateEntreprise();
            return $this->redirectToRoute('critere');
        }


        if ($this->getUser()->getRoles()[0] == 'ROLE_EXPERT') {

            return $this->redirectToRoute('binaireEvaluation');
        }

        if ($this->getUser()->getRoles()[0] == 'ROLE_MANAGER') {
            return $this->redirectToRoute('entreprise_index');
        }

        $data['evaluation'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['parent' => null],
            ['name' => 'ASC']);
        return $this->render('test.html.twig', $data);
    }


    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('test.html.twig');
    }

    /**
     * @Route("/preference", name="preference", methods={"GET"})
     */
    public function preference()
    {
        if ($this->getUser()->getEvaluateEntreprise()->getEtapes()[1]==1) {
        $entr = $this->getUser()->getEvaluateEntreprise();
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\EvaluationElements p
            WHERE p.validate = :id
            AND p.entreprise = :id1
            ORDER BY p.name DESC'
        )->setParameter('id', true)->setParameter('id1', $entr);

        // returns an array of Product objects
        $value = true;
        $data['validateCritarias'] = $query->getResult();

            if ($this->getUser()->getRoles()[0] == 'ROLE_EVALUATEUR' || $this->getUser()->getRoles()[1] == 'ROLE_EVALUATEUR') {
                $data = array();
                $data['entreprises'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findAll();
                $id = $this->getUser()->getEvaluateEntreprise()->getId();
                $data['entreprises'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(['id' => $id], ['name' => 'ASC']);
                $data['validateCritarias'] = $query->getResult();
                $data['evaluations'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['validate' => true], ['name' => 'ASC']);
                return $this->render("preferences.html.twig", $data);


        }
    }else
        if($this->getUser()->getRoles()[0] == 'ROLE_EVALUATEUR' )
           return $this->redirectToRoute('profile');
           else
           return $this->redirectToRoute('manager');

            }


    /**
     * @route("/comments/{id1}/{id2}/{value}/{type}/{entr}", name="comment_meth")
     * @return Response
     */
    public function comments($id1, $id2, $value, $type, $entr)
    {

        $query = $this->getDoctrine()->getManager();
        $eentr = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findBy(['id' => $entr]);
        $evals = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $eentr, 'validate' => true]);
        $f = $evals[$id1 - 1];
        $s = $evals[$id2 - 1];
        $res = $query->createQuery('SELECT p FROM App\Entity\Preferences p WHERE (p.evaluateur = :id3) and ( ( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))')->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $this->getUser())->getResult();
        $preferenceManger = $this->getDoctrine()->getManager();
        if (!empty($res[0])) {
            $preference = $this->getDoctrine()->getManager()->getRepository(Preferences::class)->find($res[0]->getId());

            if ($type == 2) {
                $preference->setFirstValue($value);
                $ss = number_format(1 / $value, 3);
                $preference->setSecondValue("$ss");

            } else {
                $preference->setSecondValue($value);
                $ss = number_format(1 / $value, 3);
                $preference->setFirstValue("$ss");
            }
            $preferenceManger->persist($preference);
            $preferenceManger->flush();

        } else {
            $preference = new Preferences();
            $preference->setFirstElement($f);
            $preference->setSecondElement($s);
            $preference->setEvaluateur($this->getUser());
            if ($type == 2) {
                $preference->setFirstValue($value);
                $ss = number_format(1 / $value, 3);
                $preference->setSecondValue("$ss");

            } else {
                $preference->setSecondValue($value);
                $ss = number_format(1 / $value, 3);
                $preference->setFirstValue("$ss");
            }
            $preferenceManger->persist($preference);
            $preferenceManger->flush();
        }
        $jsonData = [];
        if ($type == 1) {
            array_push($jsonData, array(
                'code' => $preference->getFirstValue(),
                'message' => 'bien ajoute',
            ));

        } else {
            array_push($jsonData, array(
                'code' => $preference->getSecondValue(),
                'message' => 'bien ajoute',
            ));

        }

        return $this->json($jsonData, 200);
    }


    /**
     * @route("/commentsB/{id1}/{id2}/{value}/{type}/{cr}", name="commentsB")
     * @return Response
     */
    public function commentsB($id1, $id2, $value, $type, $cr)
    {

        if ($this->getUser()->getExpertEntreprise() == !null) {

            $entr = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $this->getUser()->getExpertEntreprise()->getId()]);
            $query = $this->getDoctrine()->getManager();
            $evals = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $entr, 'evaluationElement' => $cr], ['name' => 'ASC']);

            $f = $evals[$id1 - 1];
            $s = $evals[$id2 - 1];

            $res = $query->createQuery('SELECT p FROM App\Entity\BinaireEvaluation p WHERE (p.createur = :id3) and (( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))')->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $this->getUser())->getResult();

            $preferenceManger = $this->getDoctrine()->getManager();
            if (!empty($res[0])) {
                $preference = $this->getDoctrine()->getManager()->getRepository(BinaireEvaluation::class)->find($res[0]->getId());

                if ($type == 2) {
                    $preference->setFirstValue($value);
                    $ss = number_format(1 / $value, 3);
                    $preference->setSecondValue("$ss");

                } else {
                    $preference->setSecondValue($value);
                    $ss = number_format(1 / $value, 3);
                    $preference->setFirstValue("$ss");
                }
                $preferenceManger->persist($preference);
                $preferenceManger->flush();

            } else {
                $preference = new BinaireEvaluation();
                $preference->setFirstElement($f);
                $preference->setSecondElement($s);
                $preference->setCreateur($this->getUser());
                if ($type == 2) {
                    $preference->setFirstValue($value);
                    $ss = number_format(1 / $value, 3);
                    $preference->setSecondValue("$ss");

                } else {
                    $preference->setSecondValue($value);
                    $ss = number_format(1 / $value, 3);
                    $preference->setFirstValue("$ss");
                }
                $preferenceManger->persist($preference);
                $preferenceManger->flush();
            }
            $jsonData = [];
            if ($type == 1) {
                array_push($jsonData, array(
                    'code' => $preference->getFirstValue(),
                    'message' => 'bien ajoute',
                ));

            } else {
                array_push($jsonData, array(
                    'code' => $preference->getSecondValue(),
                    'message' => 'bien ajoute',
                ));

            }

            return $this->json($jsonData, 200);
        } else
            return $this->json('Nothing Found', 200);

    }

    /**
     * @route("/getValues/{ent}/{id1}/{id2}/{type}", name="getValues")
     * @return Response
     */
    public function getValues($ent, $id1, $id2, $type)
    {

        $query = $this->getDoctrine()->getManager();
        $evals = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $ent, 'validate' => true], ['name' => 'ASC']);
        $f = $evals[$id1 - 1];
        $s = $evals[$id2 - 1];

        $res = $query->createQuery("SELECT p FROM App\Entity\Preferences p WHERE (p.evaluateur = :id3) and ( ( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))")->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $this->getUser())->getResult();
        $jsonData = [];


        if (!empty($res[0])) {
            if ($type == 1) {
                array_push($jsonData, array(
                    'code' => $res[0]->getSecondValue(),
                    'message' => 'SECOND VALUE',
                ));

            } else {
                array_push($jsonData, array(
                    'code' => $res[0]->getFirstValue(),
                    'message' => 'FIRST VALUE',
                ));

            }

        } else {
            array_push($jsonData, array(
                'code' => null,
                'message' => 'VALUE DOES NOT EXIST',
            ));
        }


        return $this->json($jsonData, 200);
    }


    /**
     * @route("/getValuesB/{cr}/{id1}/{id2}/{type}", name="getValuesB")
     * @return Response
     */
    public function getValuesB($cr, $id1, $id2, $type)
    {
        if ($this->getUser()->getExpertEntreprise() == !null) {

            $ent = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $this->getUser()->getExpertEntreprise()->getId()]);
            $query = $this->getDoctrine()->getManager();
            $evals = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $ent, 'evaluationElement' => $cr], ['name' => 'ASC']);
            $f = $evals[$id1 - 1];
            $s = $evals[$id2 - 1];

            $res = $query->createQuery("SELECT p FROM App\Entity\BinaireEvaluation p WHERE (p.createur = :id3) and (  ( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))")->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $this->getUser())->getResult();
            $jsonData = [];


            if (!empty($res[0])) {
                if ($type == 1) {
                    array_push($jsonData, array(
                        'code' => $res[0]->getSecondValue(),
                        'message' => 'SECOND VALUE',
                    ));

                } else {
                    array_push($jsonData, array(
                        'code' => $res[0]->getFirstValue(),
                        'message' => 'FIRST VALUE',
                    ));

                }

            } else {
                array_push($jsonData, array(
                    'code' => null,
                    'message' => 'VALUE DOES NOT EXIST',
                ));
            }


            return $this->json($jsonData, 200);
        }
    }


    /**
     * @Route("/deleteMapping/{id}", name="binaireEvaluation", methods={"GET"})
     */
    public function delteMapping($id)
    {
        $mapping = $this->getDoctrine()->getManager()->getRepository(Mapping::class)->findBy(['id' => $id]);
        if (!empty($mapping)) {
            if ($mapping[0]->getExpert() == $this->getUser()) {

                $mappingManger = $this->getDoctrine()->getManager();
                $mappingManger->remove($mapping[0]);
                $mappingManger->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'The Item Was Deleted Successfully'
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                    'alert',
                    'Something Went Wrong'
                );
            }
        } else {
            $this->get('session')->getFlashBag()->add(
                'alert',
                "No Records Found"
            );
        }

        return $this->redirectToRoute('default');
    }


    /**
     * @route("/getValuesByUser/{us}/{id1}/{id2}/{type}", name="getValuesByUser")
     * @return Response
     */
    public function getValuesByUser($us, $id1, $id2, $type)
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id' => $us]);
        $entreprise = $user->getEvaluateEntreprise();
        $query = $this->getDoctrine()->getManager();
        $evals = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $entreprise, 'validate' => true], ['name' => 'ASC']);
        $f = $evals[$id1 - 1];
        $s = $evals[$id2 - 1];
        $res = $query->createQuery("SELECT p FROM App\Entity\Preferences p WHERE (p.evaluateur = :id3) and ( ( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))")->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $user)->getResult();
        $jsonData = [];
        if (!empty($res[0])) {
            if ($type == 1) {
                array_push($jsonData, array(
                    'code' => $res[0]->getSecondValue(),
                    'message' => 'SECOND VALUE',
                ));

            } else {
                array_push($jsonData, array(
                    'code' => $res[0]->getFirstValue(),
                    'message' => 'FIRST VALUE',
                ));

            }

        } else {
            array_push($jsonData, array(
                'code' => null,
                'message' => 'VALUE DOES NOT EXIST',
            ));
        }


        return $this->json($jsonData, 200);
    }


    /**
     * @route("/getValuesBbyUser/{us}/{id1}/{id2}/{type}/{criteria}", name="getValuesBbyUser")
     * @return Response
     */
    public function getValuesBbyUser($us, $id1, $id2, $type, $criteria)
    {

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id' => $us]);
        $entreprise = $user->getExpertEntreprise();
        $query = $this->getDoctrine()->getManager();
        $evals = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['entreprise' => $entreprise, 'evaluationElement' => $criteria], ['name' => 'ASC']);

        $f = $evals[$id1 - 1];
        $s = $evals[$id2 - 1];

        $res = $query->createQuery("SELECT p FROM App\Entity\BinaireEvaluation p WHERE (p.createur = :id3) and (  ( p.firstElement = :id1 and p.secondElement = :id2 ) or ( p.firstElement = :id2 and p.secondElement = :id1 ))")->setParameter('id1', $f->getId())->setParameter('id2', $s->getId())->setParameter('id3', $user)->getResult();
        $jsonData = [];


        if (!empty($res[0])) {
            if ($type == 1) {
                array_push($jsonData, array(
                    'code' => $res[0]->getSecondValue(),
                    'message' => 'SECOND VALUE',
                ));

            } else {
                array_push($jsonData, array(
                    'code' => $res[0]->getFirstValue(),
                    'message' => 'FIRST VALUE',
                ));

            }

        } else {
            array_push($jsonData, array(
                'code' => null,
                'message' => 'VALUE DOES NOT EXIST',
            ));
        }


        return $this->json($jsonData, 200);
    }


}




