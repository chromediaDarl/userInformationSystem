<?php
// src/UserInformation/UserBundle/Controller/SecuredController.php

namespace UserInformation\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecuredController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserInformationUserBundle:Secured:index.html.twig');
    }
}