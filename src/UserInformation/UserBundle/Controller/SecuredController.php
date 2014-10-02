<?php

namespace UserInformation\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecuredController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UserInformationUserBundle:Secured:index.html.twig', array('name' => $name));
    }
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'UserInformationUserBundle:Secured:login.html.twig',
            array(
                // last email entered by the user
                'last_email' => $session->get(SecurityContext::LAST_EMAIL),
                'error'         => $error,
            )
        );
    }
}
