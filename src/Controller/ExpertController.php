<?php

namespace App\Controller;

use App\Entity\EAF;
use App\Entity\EAFElements;
use App\Entity\Entreprise;
use App\Entity\EvaluationElements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expert")
 */
class ExpertController extends AbstractController

{
    /**
     * @Route("/", name="expert")
     */
    public function index()
    {
        $data = array();
        $data['user'] = $this->getUser();
        return $this->render('expert/index.html.twig', $data);
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
                'Items Updated Successfully'
            );
        } catch (\Exception $e) {

            $this->get('session')->getFlashBag()->add(
                'changedProfileFalse',
                'Something Went Wrong'
            );
        }
        return $this->render('expert/index.html.twig');
    }


    /**
     * @Route("/alternative_elemennt", name="alternative_element")
     */
    public function alternative_element()
    {
        $data = array();
        $data1 = array();
        $arr = $this->getUser()->getExpertEntreprise()->getId();
        $data['entreprise'] = $this->getDoctrine()->getManager()->getRepository(Entreprise::class)->findOneBy(['id' => $arr], ['name' => 'ASC']);
        $data['evaluations'] = $this->getDoctrine()->getManager()->getRepository(EvaluationElements::class)->findBy(['entreprise' => $data['entreprise']]);
        $data['eafs']=[];
        foreach ($data['evaluations'] as $elements) {
            $data1['eafg'] = $this->getDoctrine()->getManager()->getRepository(EAF::class)->findBy(['evaluationElement' => $elements]);
            foreach ($data1['eafg'] as $eaf) {
                if (!is_null($eaf)){
                    array_push(  $data['eafs'], $eaf);
                }
            }
        }
        return $this->render('expert/alternative_elements.html.twig', $data);
    }


   }
