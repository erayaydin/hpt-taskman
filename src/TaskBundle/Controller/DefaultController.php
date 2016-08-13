<?php

namespace TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/task/create",name="create-task")
     */
    public function createAction()
    {
        return $this->render('@Task/Default/create-task.html.twig');
    }
}
