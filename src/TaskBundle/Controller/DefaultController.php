<?php

namespace TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use TaskBundle\Entity\Task;

class DefaultController extends Controller
{
    /**
     * @Route("/task/create",name="create-task")
     */
    public function createAction(Request $request)
    {
        $task = new Task();

        $form = $this->createFormBuilder($task)
            ->add('taskTitle', TextType::class)
            ->add('taskDescription', TextType::class)
            ->add('taskComment', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $task = $form->getData();

            $task->setFkMemberId($request->request->get('member_id'));
            $task->setFkActionId($request->request->get('action_id'));
            $task->setFkPriorityId($request->request->get('priority_id'));
            $task->setTaskCreatedDate(new \DateTime());
            $task->setTaskModificationDate(new \DateTime());
            $task->setTaskIsActive(1);
            $task->setTaskIsComplete(0);

            $validator = $this->get('validator');
            $errors = $validator->validate($task);

            if (count($errors) > 0) {
                return $this->render(
                    '@Task/Default/create-task.html.twig',
                    [
                        'form' => $form->createView(),
                        'validations_errors' => $errors,
                        'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                        'actions' => $this->getDoctrine()->getRepository('TaskBundle:Action')->all(),
                        'priorities' => $this->getDoctrine()->getRepository('TaskBundle:Priority')->all()
                    ]);
            }

            $this->getDoctrine()->getRepository('TaskBundle:Task')->add($task);
            return $this->render('@Task/Default/create-task.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'actions' => $this->getDoctrine()->getRepository('TaskBundle:Action')->all(),
                    'priorities' => $this->getDoctrine()->getRepository('TaskBundle:Priority')->all(),
                    'success' => 'true'
                ]);
        }

        return $this->render('@Task/Default/create-task.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'actions' => $this->getDoctrine()->getRepository('TaskBundle:Action')->all(),
                'priorities' => $this->getDoctrine()->getRepository('TaskBundle:Priority')->all()
            ]);
    }

    /**
     * @Route("/task/list" , name="list-task")
     */
    public function listAction()
    {
        return $this->render('@Task/Default/list-task.html.twig',
            [
                'tasks' => $this->getDoctrine()->getRepository('TaskBundle:Task')->getTaskDetails()
            ]);
    }

    /**
     * @Route("/task/remove/{id}" , name="remove-task")
     */
    public function removeAction($id)
    {
        $this->getDoctrine()->getRepository('TaskBundle:Task')->remove($id);
        return new RedirectResponse($this->generateUrl('list-task'));
    }

    /**
     * @Route("task/edit/{id}" , name="edit-task")
     */
    public function editAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getRepository('TaskBundle:Task')->find($id);

        $form = $this->createFormBuilder($task)
            ->add('taskTitle', TextType::class)
            ->add('taskDescription', TextType::class)
            ->add('taskComment', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $task = $form->getData();

            $task->setFkMemberId($request->request->get('member_id'));
            $task->setFkActionId($request->request->get('action_id'));
            $task->setFkPriorityId($request->request->get('priority_id'));
            $task->setTaskModificationDate(new \DateTime());
            $task->setTaskIsActive(1);
            $task->setTaskIsComplete(0);

            $this->getDoctrine()->getRepository('TaskBundle:Task')->update();

            return $this->render('@Task/Default/edit-task.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'members' => $this->getDoctrine()->getRepository('MemberBundle:Member')->getMembersByTeamId($this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_team_id']),
                    'actions' => $this->getDoctrine()->getRepository('TaskBundle:Action')->all(),
                    'priorities' => $this->getDoctrine()->getRepository('TaskBundle:Priority')->all(),
                    'selected_team_id' => $this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_team_id'],
                    'selected_member_id' => $this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_member_id'],
                    'selected_action_id' => $task->getFkActionId(),
                    'selected_priority_id' => $task->getFkPriorityId(),
                    'success' => 'true'
                ]);

        }

        return $this->render('@Task/Default/edit-task.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'members' => $this->getDoctrine()->getRepository('MemberBundle:Member')->getMembersByTeamId($this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_team_id']),
                'actions' => $this->getDoctrine()->getRepository('TaskBundle:Action')->all(),
                'priorities' => $this->getDoctrine()->getRepository('TaskBundle:Priority')->all(),
                'selected_team_id' => $this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_team_id'],
                'selected_member_id' => $this->getDoctrine()->getRepository('TaskBundle:Task')->getTeamDetailByTaskId($task->getPkTaskId())['pk_member_id'],
                'selected_action_id' => $task->getFkActionId(),
                'selected_priority_id' => $task->getFkPriorityId()
            ]);
    }

    /**
     * @Route("/task/getMemberByTeamAjax/{team_id}" , name="ajax-get-members-by-team")
     */
    public function getMemberByTeamAjaxAction($team_id)
    {
        return new JsonResponse(['data' => $this->getDoctrine()->getRepository('MemberBundle:Member')->getMembersByTeamId($team_id)]);
    }
}
