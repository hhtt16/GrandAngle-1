<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminType;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau collaborateur créé');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('photo')->getData();

            if ($file != null) {
                $fileName = $fileUploader->upload($file);
                $user->setPhoto($fileName);
            } 
            
            $newPsw = $request->request->get('newPsw');
            $newPswConfirm = $request->request->get('newPswConfirm');

            //if new password is given, update

            if (!empty($newPsw) && !empty($newPswConfirm)) {
                $pswHash = password_hash($newPsw, PASSWORD_DEFAULT);
                $user->setPassword($pswHash);
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Modifications bien effectuées !');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
