<?php

namespace JobsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JobsiteBundle:Default:index.html.twig', array('name' => 'Welcome JobSite Demo'));
    }
}
