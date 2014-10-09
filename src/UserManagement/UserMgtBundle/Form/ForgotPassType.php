<?php
// src/UserManagement/UserMgtBundle/Form/ForgotPassType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class ForgotPassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('password', 'password', array('constraints' => array( new SecurityAssert\UserPassword(array('message' => 'Password did not match your current password'))), 'label' => false , 'attr' => array('placeholder' => 'Current Password', 'class' => 'form-control')));
        $builder->add('email', 'email', array('constraints' => array( new Email(array('message' => 'Invalid email'))),'label' => false , 'attr' => array('placeholder' => 'Email Address', 'class' => 'form-control')));
        //$builder->add('password', 'repeated', array(
            //'type' => 'password',
            //'invalid_message' => 'The password fields must match. It should be %num% alphanumeric characters',
            //'invalid_message_parameters' => array('%num%' => 6),
            //'options' => array('attr' => array('class' => 'form-control')),
            //'required' => true,
            //'first_options'  => array('label' => false , 'attr' => array('placeholder' => 'New Password', 'class' => 'form-control')),
            //'second_options' => array('label' => false , 'attr' => array('placeholder' => 'Confirm New Password', 'class' => 'form-control')),
        //));
    }

    public function getName()
    {
        return 'forgotpass';
    }
}