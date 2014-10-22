<?php
// src/UserManagement/UserMgtBundle/Form/ContactType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', 'text', array('constraints' => array( new NotBlank(array('message' => 'First Name is requuired'))),'label' => false , 'attr' => array('placeholder' => 'First Name', 'class' => 'form-control')));
        $builder->add('lastname', 'text', array('constraints' => array( new NotBlank(array('message' => 'Last Name is requuired'))),'label' => false , 'attr' => array('placeholder' => 'Last Name', 'class' => 'form-control')));
        $builder->add('email', 'email', array('constraints' => array( new Email(array('message' => 'Invalid email'))),'label' => false , 'attr' => array('placeholder' => 'Email Address', 'class' => 'form-control')));
        $builder->add('phone', 'text', array('label' => false , 'attr' => array('placeholder' => 'Phone Number', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'contact';
    }
}