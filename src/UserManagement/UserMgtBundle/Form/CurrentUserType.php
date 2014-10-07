<?php
// src/UserManagement/UserMgtBundle/Form/CurrentUserType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CurrentUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array('label' => false , 'read_only' => true , 'attr' => array('placeholder' => 'Email Address', 'class' => 'form-control')));
        $builder->add('fname', 'text', array('label' => false , 'attr' => array('placeholder' => 'First Name', 'class' => 'form-control')));
        $builder->add('lname', 'text', array('label' => false , 'attr' => array('placeholder' => 'Last Name', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'currentuser';
    }
}