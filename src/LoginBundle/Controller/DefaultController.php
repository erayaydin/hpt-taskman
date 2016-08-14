<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/" , name="login")
     */
    public function indexAction(Request $request)
    {
        //local static string variable
        $login_status_nothing = "nothing";
        $login_status_error = "error";

        //always cleared the session object
        $session = $this->get('session');
        $session->clear();

        if ($request->isMethod('POST')) {

            $member_email = $request->request->get('member_email');
            $member_password = $request->request->get('member_password');

            $result = $this->getDoctrine()->getRepository('MemberBundle:Member')->getMemberByEmailAndPassword($member_email, $member_password);
            if ($result) {
                $session->start();

                $session->set('active_member_id', $result['pk_member_id']);
                return $this->render('@Main/Default/index.html.twig');

            } else {

                return $this->render('@Login/Default/login.html.twig',
                    [
                        'login_status' => $login_status_error
                    ]);
            }
        }

        return $this->render('@Login/Default/login.html.twig',
            [
                'login_status' => $login_status_nothing
            ]);
    }
}
