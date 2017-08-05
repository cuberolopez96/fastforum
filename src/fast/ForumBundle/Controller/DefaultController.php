<?php

namespace fast\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('fastForumBundle:Default:index.html.twig');
    }
}
