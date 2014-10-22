<?php

namespace UserManagement\UserMgtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

use UserManagement\UserMgtBundle\Entity\User;
use UserManagement\UserMgtBundle\Entity\UserContact;
use UserManagement\UserMgtBundle\Form\UserType;
use UserManagement\UserMgtBundle\Form\ContactType;

class ContactController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

    	$session = $request->getSession();
        $user = $session->get('user');

        $contacts = new UserContact();
        $contacts = $this->getDoctrine()
                ->getRepository('UserManagementUserMgtBundle:UserContact')
                ->findBy(array('user' => $user));

        if(!$contacts){
        	$this->get('session')->getFlashBag()->add('alert-info', 'No Contacts yet.');
            return $this->render('UserManagementUserMgtBundle:Contacts:list.html.twig', array(
	            'contacts' => $contacts
	        ));
        }
        return $this->render('UserManagementUserMgtBundle:Contacts:list.html.twig', array('contacts' => $contacts));
    }

    public function addContactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $userID = $session->get('userid');

        $user = new User();
        $user = $this->getDoctrine()
            ->getRepository('UserManagementUserMgtBundle:User')
            ->findOneBy(array('id' => $userID));

        $contact = new UserContact();
        $form = $this->createForm(new ContactType(), $contact);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $contact = $contact->setUser($user);
                $em->persist($contact);
                $em->flush();
                $this->get('session')->getFlashBag()->add('alert-success', 'You have successfully add a contact.');
                return $this->redirect($this->generateUrl('add-contacts'));
            }
        }

        return $this->render('UserManagementUserMgtBundle:Contacts:addcontact.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function editContactAction($id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $contact = $this->getDoctrine()
            ->getRepository('UserManagementUserMgtBundle:UserContact')
            ->findOneBy(array('id' => $id));

        $form = $this->createForm(new ContactType(), $contact);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $em->persist($contact);
                //var_dump($contact);
                //exit;
                $em->flush();
                $this->get('session')->getFlashBag()->add('alert-success', 'You have successfully updated your contact.');
                return $this->redirect($this->generateUrl('edit-contacts', array('id' => $id)));
            }else{
                foreach ($form->getErrors() as $er) {
                    $er;
                }
                $this->get('session')->getFlashBag()->add('alert-danger', $er);
                return $this->redirect($this->generateUrl('edit-contacts'));
            }
        }

        return $this->render('UserManagementUserMgtBundle:Contacts:editcontact.html.twig', array(
            'form' => $form->createView(),
            'contact' => $contact
        ));
    }
    public function deleteContactAction($id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $contact = $this->getDoctrine()
            ->getRepository('UserManagementUserMgtBundle:UserContact')
            ->findOneBy(array('id' => $id));

        if ($contact) {
            $em->remove($contact);
            $em->flush();
            $this->get('session')->getFlashBag()->add('alert-success', 'You have successfully deleted your contact.');
                return $this->redirect($this->generateUrl('contacts', array('id' => $id)));
        }else{
            foreach ($form->getErrors() as $er) {
                $er;
            }
            $this->get('session')->getFlashBag()->add('alert-danger', $er);
            return $this->redirect($this->generateUrl('contacts'));
        }
    }
}