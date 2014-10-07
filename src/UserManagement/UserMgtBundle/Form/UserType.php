<?php
// src/UserManagement/UserMgtBundle/Form/UserType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fname', 'text', array('constraints' => array( new NotBlank(array('message' => 'First Name is requuired'))),'label' => false , 'attr' => array('placeholder' => 'First Name', 'class' => 'form-control')));
        $builder->add('lname', 'text', array('constraints' => array( new NotBlank(array('message' => 'Last Name is requuired'))),'label' => false , 'attr' => array('placeholder' => 'Last Name', 'class' => 'form-control')));
        $builder->add('email', 'email', array('constraints' => array( new Email(array('message' => 'Invalid email'))),'label' => false , 'attr' => array('placeholder' => 'Email Address', 'class' => 'form-control')));
        $builder->add('password', 'password', array(
            'constraints' => array( new Length(array('min'=> 6, 'minMessage' => 'New Password must be at least {{ limit }} characters long'))),
            'label' => false , 'attr' => array('placeholder' => 'Password', 'class' => 'form-control')));
        $builder->add('conpassword', 'password', array('label' => false , 'attr' => array('placeholder' => 'Confirm Password', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'user';
    }
}