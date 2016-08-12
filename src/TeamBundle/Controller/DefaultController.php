<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use TeamBundle\Entity\Team;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use TeamBundle\Service\FileUploader;

class DefaultController extends Controller
{

    /**
     * @Route("/team/create" , name="create-team")
     */
    public function createAction(Request $request)
    {
        $image_yes = 'image_yes';
        $image_no = 'image_no';
        $image_uknow = 'image_uknown';

        $team = new Team();
        $form = $this->createFormBuilder($team)
            ->add('teamName', TextType::class)
            ->add('teamSlogan', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $team = $form->getData();

            //install image
            $image = $request->files->get('team_photo');
            $uploadDir = $this->getParameter('upload_dir');

            if ($image) {
                FileUploader::run($image, $uploadDir);

                $team->setTeamPhoto($image->getClientOriginalName());
                $team->setTeamCreatedDate(new \DateTime());
                $team->setTeamModificationDate(new \DateTime());

                $validator = $this->get('validator');
                $errors = $validator->validate($team);

                if (count($errors) > 0) {
                    return $this->render(
                        'TeamBundle:Default:create-team.html.twig',
                        [
                            'form' => $form,
                            'validations_errors' => $errors,
                            'image_status' => $image_yes
                        ]);
                }

                $this->getDoctrine()->getRepository('TeamBundle:Team')->add($team);

                return $this->render(
                    'TeamBundle:Default:create-team.html.twig',
                    [
                        'form' => $form->createView(),
                        'success' => 'true',
                        'image_status' => $image_yes
                    ]);
            } else {
                return $this->render(
                    'TeamBundle:Default:create-team.html.twig',
                    [
                        'form' => $form->createView(),
                        'image_status' => $image_no
                    ]);
            }
            //install image
        }

        return $this->render(
            'TeamBundle:Default:create-team.html.twig',
            [
                'form' => $form->createView(),
                'image_status' => $image_uknow
            ]);
    }

    /**
     * @Route("/team/list" , name="list-team")
     */
    public function listAction()
    {
        return $this->render('@Team/Default/list-team.html.twig',
            [
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all()
            ]);
    }

    /**
     * @Route("/team/remove/{id}",name="remove-team")
     */
    public function removeAction($id)
    {
        $this->getDoctrine()->getRepository('TeamBundle:Team')->remove($id);
        return new RedirectResponse($this->generateUrl('list-team'));
    }

    /**
     * @Route("/team/edit/{id}" , name="edit-team")
     */
    public function editAction(Request $request, $id)
    {
        $team = $this->getDoctrine()->getRepository('TeamBundle:Team')->get($id);

        $form = $this->createFormBuilder($team)
            ->add('teamName', TextType::class)
            ->add('teamSlogan', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            //install image
            $image = $request->files->get('team_photo');
            $uploadDir = $this->getParameter('upload_dir');

            if ($image) {
                FileUploader::run($image, $uploadDir);
                $team->setTeamPhoto($image->getClientOriginalName());
            }

            //install image

            $team->setTeamModificationDate(new \DateTime());
            $this->getDoctrine()->getRepository('TeamBundle:Team')->update();

            return $this->render(
                '@Team/Default/edit-team.html.twig',
                [
                    'form' => $form->createView(),
                    'current_team_photo' => $team->getTeamPhoto(),
                    'success' => 'true'
                ]);
        }

        return $this->render(
            '@Team/Default/edit-team.html.twig',
            [
                'form' => $form->createView(),
                'current_team_photo' => $team->getTeamPhoto()
            ]);
    }

}
