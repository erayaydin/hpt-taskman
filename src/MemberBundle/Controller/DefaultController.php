<?php

namespace MemberBundle\Controller;

use MemberBundle\Entity\Member;
use MemberBundle\Manager\Password\PasswordManager;
use MemberBundle\Service\Password\PasswordServiceAnormal;
use MemberBundle\Service\Password\PasswordServiceNormal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/member/create" , name="create-member")
     */
    public function createAction(Request $request)
    {
        $member = new Member();
        $p_manager = new PasswordManager(new PasswordServiceNormal());

        $form = $this->createFormBuilder($member)
            ->add('memberName', TextType::class)
            ->add('memberSurname', TextType::class)
            ->add('memberEmail', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $member = $form->getData();

            $member->setFkTeamId($request->request->get('team_id'));
            $member->setFkRoleId($request->request->get('role_id'));
            $member->setMemberCreatedDate(new \DateTime());
            $member->setMemberModificationDate(new \DateTime());
            $member->setMemberPassword(10);

            $validator = $this->get('validator');
            $errors = $validator->validate($member);

            if (count($errors) > 0) {
                return $this->render(
                    'MemberBundle:Default:create-member.html.twig',
                    [
                        'form' => $form->createView(),
                        'validations_errors' => $errors,
                        'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                        'roles' => $this->getDoctrine()->getRepository('MemberBundle:Role')->all()
                    ]);
            }

            $this->getDoctrine()->getRepository('MemberBundle:Member')->add($member);
            return $this->render('@Member/Default/create-member.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'roles' => $this->getDoctrine()->getRepository('MemberBundle:Role')->all(),
                    'success' => 'true'
                ]);
        }

        return $this->render('@Member/Default/create-member.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'roles' => $this->getDoctrine()->getRepository('MemberBundle:Role')->all()
            ]);
    }

    /**
     * @Route("/member/list",name="list-member")
     */
    public function listAction()
    {
        return $this->render('MemberBundle:Default:list-member.html.twig',
            [
                'members' => $this->getDoctrine()->getRepository('MemberBundle:Member')->getMemberDetails()
            ]);
    }

    /**
     * @Route("/member/remove/{id}" , name="remove-member")
     */
    public function removeAction($id)
    {
        $this->getDoctrine()->getRepository('MemberBundle:Member')->remove($id);
        return new RedirectResponse($this->generateUrl('list-member'));
    }

    /**
     * @Route("/member/edit/{id}" , name="edit-member")
     */
    public function editAction(Request $request, $id)
    {
        $member = $this->getDoctrine()->getRepository('MemberBundle:Member')->getId($id);

        $form = $this->createFormBuilder($member)
            ->add('memberName', TextType::class)
            ->add('memberSurname', TextType::class)
            ->add('memberEmail', TextType::class)
            ->add('Submit', SubmitType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $member = $form->getData();

            $member->setFkTeamId($request->request->get('team_id'));
            $member->setFkRoleId($request->request->get('role_id'));
            $member->setMemberModificationDate(new \DateTime());

            $this->getDoctrine()->getRepository('MemberBundle:Member')->update();

            return $this->render('@Member/Default/edit-member.html.twig',
                [
                    'form' => $form->createView(),
                    'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                    'roles' => $this->getDoctrine()->getRepository('MemberBundle:Role')->all(),
                    'success' => 'true',
                    'selected_team_id' => $member->getFkTeamId(),
                    'selected_role_id' => $member->getFkRoleId()
                ]);
        }

        return $this->render('@Member/Default/edit-member.html.twig',
            [
                'form' => $form->createView(),
                'teams' => $this->getDoctrine()->getRepository('TeamBundle:Team')->all(),
                'roles' => $this->getDoctrine()->getRepository('MemberBundle:Role')->all(),
                'selected_team_id' => $member->getFkTeamId(),
                'selected_role_id' => $member->getFkRoleId()
            ]);
    }
}
