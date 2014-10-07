<?php
// src/UserManagement/UserMgtBundle/Form/ChangePassType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangePassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'password', array('label' => false , 'attr' => array('placeholder' => 'New Password', 'class' => 'form-control')));
        $builder->add('conpassword', 'password', array('label' => false , 'attr' => array('placeholder' => 'Confirm New Password', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'changepass';
    }
}