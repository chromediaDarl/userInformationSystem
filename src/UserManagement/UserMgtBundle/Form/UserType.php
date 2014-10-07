<?php
// src/UserManagement/UserMgtBundle/Form/UserType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fname', 'text', array('label' => false , 'attr' => array('placeholder' => 'First Name', 'class' => 'form-control')));
        $builder->add('lname', 'text', array('label' => false , 'attr' => array('placeholder' => 'Last Name', 'class' => 'form-control')));
        $builder->add('email', 'email', array('label' => false , 'attr' => array('placeholder' => 'Email Address', 'class' => 'form-control')));
        $builder->add('password', 'password', array(
            'constraints' => array( new NotBlank(array('message' => 'Password is requuired'))),
            'label' => false , 'attr' => array('placeholder' => 'Password', 'class' => 'form-control')));
        $builder->add('conpassword', 'password', array('label' => false , 'attr' => array('placeholder' => 'Confirm Password', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'user';
    }
}