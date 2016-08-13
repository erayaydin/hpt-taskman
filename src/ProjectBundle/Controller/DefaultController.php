<?php

namespace ProjectBundle\Controller;

use ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/project/create", name="create-project")
     */
    public function createAction(Request $request)
    {
        $project = new Project();

        $form = $this->createFormBuilder($project)
            ->add('projectName', TextType::class)
            ->add('projectDescription', TextType::class)
            ->add('projectProperty', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $project = $form->getData();

            $project->setFkTeamId($request->request->get('team_id'));
            $project->setFkProjectTypeId($request->request->get('project_type_id'));
            $project->setProjectCreatedDate(new \DateTime());

            $validator = $this->get('validator');
            $errors = $validator->validate($project);

            if (count($errors) > 0) {
                return $this->render(
                    '@Project/Default/create-project.html.twig',
                    [
                        'form' => $form->createView(),
                        'validations_errors' => $errors,
                        'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                        'project_types' => $this->getDoctrine()->getRepository('ProjectBundle:ProjectType')->all()
                    ]);
            }

            $this->getDoctrine()->getRepository('ProjectBundle:Project')->add($project);
            return $this->render('@Project/Default/create-project.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'project_types' => $this->getDoctrine()->getRepository('ProjectBundle:ProjectType')->all(),
                    'success' => 'true'
                ]);
        }

        return $this->render('@Project/Default/create-project.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'project_types' => $this->getDoctrine()->getRepository('ProjectBundle:ProjectType')->all()
            ]);
    }

    /**
     * @Route("/project/list", name="list-project")
     */
    public function listAction()
    {
        return $this->render('@Project/Default/list-project.html.twig',
            [
                'projects' => $this->getDoctrine()->getRepository('ProjectBundle:Project')->getProjectDetails()
            ]);
    }

    /**
     * @Route("/project/remove/{id}",name="remove-project")
     */
    public function removeProject($id)
    {
        $this->getDoctrine()->getRepository('ProjectBundle:Project')->remove($id);
        return new RedirectResponse($this->generateUrl('list-project'));
    }

    /**
     * @Route("/project/edit/{id}",name="edit-project")
     */
    public function editAction(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository('ProjectBundle:Project')->find($id);

        $form = $this->createFormBuilder($project)
            ->add('projectName', TextType::class)
            ->add('projectDescription', TextType::class)
            ->add('projectProperty', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $project = $form->getData();

            //$project->setFkTeamId($request->request->get('team_id'));// not update to team.
            $project->setFkProjectTypeId($request->request->get('project_type_id'));

            $this->getDoctrine()->getRepository('ProjectBundle:Project')->update();

            return $this->render('@Project/Default/edit-project.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'project_types' => $this->getDoctrine()->getRepository('ProjectBundle:ProjectType')->all(),
                    'selected_team_id' => $project->getFkTeamId(),
                    'selected_project_type_id' => $project->getFkProjectTypeId(),
                    'success' => 'true'
                ]);
        }

        return $this->render('@Project/Default/edit-project.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'project_types' => $this->getDoctrine()->getRepository('ProjectBundle:ProjectType')->all(),
                'selected_team_id' => $project->getFkTeamId(),
                'selected_project_type_id' => $project->getFkProjectTypeId()
            ]);
    }
}
