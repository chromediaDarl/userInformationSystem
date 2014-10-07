<?php

namespace UserManagement\UserMgtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
// Import new namespaces
use UserManagement\UserMgtBundle\Entity\User;
use UserManagement\UserMgtBundle\Form\UserType;
use UserManagement\UserMgtBundle\Form\CurrentUserType;

class DefaultController extends Controller
{
	public function loginAction(Request $request)
    {

        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'UserManagementUserMgtBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('UserManagementUserMgtBundle:Default:index.html.twig', array('user' => $user));
    }

    public function signupAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $email = $form["email"]->getData();
                $fname = $form["fname"]->getData();
                $lname = $form["lname"]->getData();
                $pass = $form["password"]->getData();
                $cpass = $form["conpassword"]->getData();

                if ( $pass != $cpass){
                    $this->get('session')->getFlashBag()->add('alert-danger', 'Password mismatch');
                }
                else{
                    $user->setEmail($email);
                    $user->setFname($fname);
                    $user->setLname($lname);
                    $user->setIsActive(0);
                    $user->setSalt(md5(uniqid()));
                    $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
                    $user->setPassword($encoder->encodePassword($pass, $user->getSalt()));

                    $em->persist($user);
                    $em->flush();
                }
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                $this->get('session')->getFlashBag()->add('alert-success', 'You have successfully created your account. Please click the link sent to your mailbox for account confirmation. Thank you.');
                return $this->redirect($this->generateUrl('login'));
            }
        }

        return $this->render('UserManagementUserMgtBundle:Default:signup.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function profileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $currentUser = $this->getUser();

        $form = $this->createForm(new CurrentUserType(), $currentUser);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $fname = $form["fname"]->getData();
                $lname = $form["lname"]->getData();
                echo '<pre>Last Name: '.var_dump($lname).'</pre>';
                echo '<pre>First Name: '.var_dump($fname).'</pre>';
                exit;
                $currentUser->setFname($fname);
                $currentUser->setLname($lname);

                $em->persist($currentUser);
                $em->flush();
            }
            else{
                foreach ($form->getErrors() as $er) {
                	var_dump($er);
                	exit;
                }
            }

        }
        return $this->render('UserManagementUserMgtBundle:Default:profile.html.twig', array('form' => $form->createView()));
    }
}
