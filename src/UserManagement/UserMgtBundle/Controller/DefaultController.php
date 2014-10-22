<?php

namespace UserManagement\UserMgtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\DateTime;
// Import new namespaces
use UserManagement\UserMgtBundle\Entity\User;
use UserManagement\UserMgtBundle\Entity\Confirm;
use UserManagement\UserMgtBundle\Form\UserType;
use UserManagement\UserMgtBundle\Form\CurrentUserType;
use UserManagement\UserMgtBundle\Form\ChangePassType;
use UserManagement\UserMgtBundle\Form\ForgotPassType;
use UserManagement\UserMgtBundle\Form\ResetPassType;

class DefaultController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('UserManagementUserMgtBundle:Default:welcome.html.twig', array());
    }
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
        }else {
            $error = '';
        }

        //if (!$this->getIsActive()){
            //$error = 'Please confirm your email address first to activate your account';
        //} 

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

    public function indexAction(Request $request)
    {
        //var_dump($this->get('swiftmailer.mailer.default.plugin.messagelogger'));
        $session = $request->getSession();
        $user = $this->getUser();
        $session->set('user', $user); 
        return $this->render('UserManagementUserMgtBundle:Default:index.html.twig', array('user' => $user));
    }

    public function signupAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $session = $request->getSession();

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $pass = $form["password"]->getData();
                $cpass = $form["conpassword"]->getData();

                if ( $pass != $cpass){
                    $this->get('session')->getFlashBag()->add('alert-danger', 'Password mismatch');
                    return $this->redirect($this->generateUrl('signup'));
                }
                else{
                    $user->setIsActive(0);
                    $user->setSalt(md5(uniqid()));
                    $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
                    $user->setPassword($encoder->encodePassword($pass, $user->getSalt()));

                    $em->persist($user);
                    
                    //Confirmation Email Table
                    $confirm = new Confirm();
                    $confirm = $confirm->setUser($user);
                    $confirm->setEmail($form["email"]->getData());
                    $key = md5(uniqid($form["email"]->getData()));
                    //var_dump($date);
                    //exit;
                    $confirm->setConfirmKey($key);
                    $date = new \DateTime('now'); 
                    $date = $date->format('YmdHis');
                    $confirm->setconfirmDate(new \DateTime($date));
                    $confirm->setIsConfirmed(0);
                    $url = $this->generateUrl('confirm', array('key' => $key, 'date' => $date ),true);
                    $em->persist($confirm);

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Email Confirmation')
                        ->setFrom('kimberlydarl.barbadillo@chromedia.com')
                        ->setTo($form["email"]->getData())
                        ->setBody($this->renderView('UserManagementUserMgtBundle:Default:confirmEmail.html.twig', array('confirm' => $confirm, 'user' => $user, 'url' => $url)), 'text/html');
                    $this->get('mailer')->send($message);

                    $em->flush();

                    $this->get('session')->getFlashBag()->add('alert-success', 'You have successfully created your account. Please click the link sent to your mailbox for account confirmation. Thank you.');
                    return $this->redirect($this->generateUrl('login'));
                }
            }
        }

        return $this->render('UserManagementUserMgtBundle:Default:signup.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function confirmAccountAction($key,$date)
    {
        $em = $this->getDoctrine()->getManager();

        $confirm = new Confirm();
        $confirm = $this->getDoctrine()
                ->getRepository('UserManagementUserMgtBundle:Confirm')
                ->findOneBy(array('confirmkey' => $key));
        if(!$confirm){
            $this->get('session')->getFlashBag()->add('alert-danger', 'Invalid confirmation link');
                    return $this->redirect($this->generateUrl('login'));
        }else{
            $IsConfirmed = $confirm->getIsConfirmed();
            if($IsConfirmed == true){
                $this->get('session')->getFlashBag()->add('alert-success', 'Account is already activated');
                    return $this->redirect($this->generateUrl('login'));
            }else{
                $userID = $confirm->getUser();

                $user = new User();
                $user = $this->getDoctrine()
                    ->getRepository('UserManagementUserMgtBundle:User')
                    ->findOneBy(array('id' => $userID));
                $user->setIsActive(1);

                $em->persist($user);
                $em->remove($confirm);

                $em->flush();

                $this->get('session')->getFlashBag()->add('alert-success', 'Successfully activated your account.');
                    return $this->redirect($this->generateUrl('login'));
            }
        }

        return $this->render('UserManagementUserMgtBundle:Default:confirmAccount.html.twig', array('key' => $key, 'date' => $date));
    }

    public function profileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $currentUser = $this->getUser();

        $form = $this->createForm(new CurrentUserType(), $currentUser);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($currentUser);
                $em->flush();
                $this->get('session')->getFlashBag()->add('alert-success', 'Successfully updated profile.');
                return $this->redirect($this->generateUrl('profile'));
            }
            else{
                foreach ($form->getErrors() as $er) {
                    $er;
                }
                $this->get('session')->getFlashBag()->add('alert-danger', $er);
                return $this->redirect($this->generateUrl('profile'));
            }

        }
        return $this->render('UserManagementUserMgtBundle:Default:profile.html.twig', array('form' => $form->createView(), 'user' => $currentUser));
    }
    public function changepassAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $currentUser = $this->getUser();
        $curPass = $currentUser->getPassword();

        $form = $this->createForm(new ChangePassType(), $currentUser);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $pass = $form["password"]->getData();
                $encoder = $this->container->get('security.encoder_factory')->getEncoder($currentUser);
                $pass = $encoder->encodePassword($pass, $currentUser->getSalt());
                //var_dump($curPass);
                //var_dump($pass);
                //exit;
                $newpass = $form["newpassword"]->getData();
                $cnpass = $form["connewpassword"]->getData();

                if ($pass != $curPass){
                    $this->get('session')->getFlashBag()->add('alert-danger', 'Incorrect current password');
                    return $this->redirect($this->generateUrl('changepass'));
                }
                elseif ( $newpass != $cnpass){
                    $this->get('session')->getFlashBag()->add('alert-danger', 'Password mismatch');
                    return $this->redirect($this->generateUrl('changepass'));
                }
                else{
                    $encoder = $this->container->get('security.encoder_factory')->getEncoder($currentUser);
                    $currentUser->setPassword($encoder->encodePassword($newpass, $currentUser->getSalt()));

                    $em->persist($currentUser);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('alert-success', 'Successfully changed password.');
                    return $this->redirect($this->generateUrl('changepass'));
                }
            }
            else{
                foreach ($form->getErrors() as $er) {
                    $this->get('session')->getFlashBag()->add('alert-danger',$er);
                    return $this->redirect($this->generateUrl('changepass'));
                }
            }

        }
        return $this->render('UserManagementUserMgtBundle:Default:changepass.html.twig', array('form' => $form->createView()));
    }
    public function forgotPassAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ForgotPassType());

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $email = $form["email"]->getData();
                $user = new User();
                $user = $this->getDoctrine()
                    ->getRepository('UserManagementUserMgtBundle:User')
                    ->findOneBy(array('email' => $email));
                if(!$user){
                    $this->get('session')->getFlashBag()->add('alert-danger', 'Email address not yet registered.');
                    return $this->redirect($this->generateUrl('forgotpass'));
                }else{
                    $email = $user->getEmail();
                    //Confirmation Email Table
                    $confirm = new Confirm();
                    $confirm = $confirm->setUser($user);
                    $confirm->setEmail($email);
                    $key = md5(uniqid($email));
                    $confirm->setConfirmKey($key);
                    $date = new \DateTime('now'); 
                    $date = $date->format('YmdHis');
                    $confirm->setconfirmDate(new \DateTime($date));
                    $confirm->setIsConfirmed(0);
                    $url = $this->generateUrl('reset', array('key' => $key, 'date' => $date ),true);

                    $em->persist($confirm);

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Password Reset')
                        ->setFrom('kimberlydarl.barbadillo@chromedia.com')
                        ->setTo($email)
                        ->setBody($this->renderView('UserManagementUserMgtBundle:Default:forgotPassEmail.html.twig', array('confirm' => $confirm, 'user' => $user, 'url' => $url)), 'text/html');
                    $this->get('mailer')->send($message);

                    $em->flush();

                    $this->get('session')->getFlashBag()->add('alert-success', 'Please click the link sent to your mailbox for resetting of password. Thank you.');
                    return $this->redirect($this->generateUrl('login'));
                }
            }
        }

        return $this->render('UserManagementUserMgtBundle:Default:forgotpass.html.twig', array('form' => $form->createView()));
    }
    public function resetConfirmAction($key,$date)
    {
        $em = $this->getDoctrine()->getManager();

        $confirm = new Confirm();
        $confirm = $this->getDoctrine()
                ->getRepository('UserManagementUserMgtBundle:Confirm')
                ->findOneBy(array('confirmkey' => $key));
        if(!$confirm){
            $this->get('session')->getFlashBag()->add('alert-danger', 'Invalid reset password link');
                    return $this->redirect($this->generateUrl('login'));
        }else{
            $IsConfirmed = $confirm->getIsConfirmed();
            $currentDate = new \DateTime('now'); 
            $date = date("YmdHis",strtotime($date));
            $dateTime = new \DateTime($date);
            $timeDiff = date_diff($currentDate,$dateTime);
            $timeDiff = $timeDiff->format('%a');
            if($timeDiff >= 1){
                $this->get('session')->getFlashBag()->add('alert-danger', 'Reset Password link already expired. Login or click forgot password again.');
                    return $this->redirect($this->generateUrl('login'));
            }else{
                $userID = $confirm->getUser();

                $user = new User();
                $user = $this->getDoctrine()
                    ->getRepository('UserManagementUserMgtBundle:User')
                    ->findOneBy(array('id' => $userID));

                $form = $this->createForm(new ResetPassType(), $user);

                $em->persist($user);
                $em->remove($confirm);

                $em->flush();

                //$this->get('session')->getFlashBag()->add('alert-success', 'Successfully activated your account.');
                    //return $this->redirect($this->generateUrl('login'));
                return $this->render('UserManagementUserMgtBundle:Default:resetpass.html.twig', array('form' => $form->createView(), 'user' => $user));
            }
        }

        return $this->render('UserManagementUserMgtBundle:Default:resetConfirm.html.twig', array('key' => $key, 'date' => $date));
    }

    public function resetPassAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ResetPassType());

        $userID = $request->request->get('id');

        $user = new User();
        $user = $this->getDoctrine()
            ->getRepository('UserManagementUserMgtBundle:User')
            ->findOneBy(array('id' => $userID));

        $form = $this->createForm(new ResetPassType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {

                $pass = $form["password"]->getData();

                $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
                $user->setPassword($encoder->encodePassword($pass, $user->getSalt()));

                $em->persist($user);
                $em->flush();

                $this->get('session')->getFlashBag()->add('alert-success', 'Successfully changed password.');
                return $this->redirect($this->generateUrl('login'));
            }
            else{

                foreach ($form->getErrors() as $er) {
                    $this->get('session')->getFlashBag()->add('alert-danger',$er);
                    return $this->redirect($this->generateUrl('resetpass'));
                }
            }

        }
        return $this->render('UserManagementUserMgtBundle:Default:resetpass.html.twig', array('form' => $form->createView(), 'user' => $user));
    }
}
