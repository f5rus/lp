<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => 'Username',
                'label_attr' => array(
                    'class' => 'fieldlabel'
                ),
                'attr' => array(
                    'class' => 'txt w-input',
                    'data-name' => 'Name',
                    'id' => 'name',
                    'maxlength' => '256',
                    'name' => 'name',
                    'placeholder' => 'Enter your Username or Email'
                ),
                'required' => false
            ))
            ->add('password', null, array(
                'label' => 'Password',
                'label_attr' => array(
                    'class' => 'fieldlabel numb2'
                ),
                'attr' => array(
                    'autofocus' => 'autofocus',
                    'class' => 'txt w-input',
                    'data-name' => 'Password',
                    'id' => 'Password',
                    'maxlength' => '256',
                    'name' => 'Password',
                    'placeholder' => 'Your password'
                ),
                'required' => false
            ))
            ->add('send', SubmitType::class, array(
                'label' => 'Sign in',
                'attr' => array(
                    'class' => 'signin w-button'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array(
                'class' => 'login',
                'data-name'=> 'Email Form',
                'id' => 'email-form',
                'name' => 'email-form'
            )
        ));
    }
}
