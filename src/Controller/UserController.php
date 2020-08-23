<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        if($this->getUser()->getRoles()[0]=='ROLE_MANAGER'){
            return $this->render('user/index.html.twig', [
                'users' => $userRepository->findBy(
                    ['generated_by'=>$this->getUser()]
                ),
            ]);
        }else{
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = new User();

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($new_password);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('user_index');
            }
            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }else{
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            $user->setRoles(['ROLE_MANAGER']);
            $user->setEnabled(true);

            if ($form->isSubmitted() && $form->isValid()) {
                $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($new_password);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('default');
            }
            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        if($this->getUser()->getRoles()[0]=='ROLE_MANAGER'){
            if ($user->getGeneratedBy()==(string) $this->getUser()->getId()){

                 return $this->render('user/show.html.twig', [
                    'user' => $user,
                ]);
            }else{
                return $this->render('user/index.html.twig', [
                    'users' => $this->getDoctrine()->getManager()->getRepository(User::class)->findBy(
                        ['generated_by'=>$this->getUser()]
                    ),
                ]);
            }
        }
        return $this->render('user/show.html.twig', [
               'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, User $user): Response
    {
        if($this->getUser()->getRoles()[0]=='ROLE_MANAGER'){
        if ($user->getGeneratedBy()==(string) $this->getUser()->getId()){

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $user->setPassword($new_password);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('user_index');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);


        }else{
            $this->redirectToRoute('generate_evaluateures');
        }
    }


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $user->setPassword($new_password);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {

        if($this->getUser()->getRoles()[0]=='ROLE_MANAGER'){
            if ($user->getGeneratedBy()==(string) $this->getUser()->getId()){

                if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($user);
                    $entityManager->flush();
                }

                if ($user->getEvaluateEntreprise())
                    return $this->redirectToRoute('generate_evaluateures');
                else
                    return $this->redirectToRoute('generate_experts');

            }else{
                if ($user->getEvaluateEntreprise())
                    return $this->redirectToRoute('generate_evaluateures');
                else
                    return $this->redirectToRoute('generate_experts');
            }
        }
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
