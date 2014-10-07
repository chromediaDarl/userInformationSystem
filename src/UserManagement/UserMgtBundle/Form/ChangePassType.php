<?php
// src/UserManagement/UserMgtBundle/Form/ChangePassType.php

namespace UserManagement\UserMgtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

class ChangePassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'password', array('label' => false , 'attr' => array('placeholder' => 'Current Password', 'class' => 'form-control')));
        $builder->add('newpassword', 'password', array('constraints' => array( new Length(array('min'=> 6, 'minMessage' => 'New Password must be at least {{ limit }} characters long'))), 'label' => false , 'attr' => array('placeholder' => 'New Password', 'class' => 'form-control')));
        $builder->add('connewpassword', 'password', array('label' => false , 'attr' => array('placeholder' => 'Confirm New Password', 'class' => 'form-control')));
    }

    public function getName()
    {
        return 'changepass';
    }
}