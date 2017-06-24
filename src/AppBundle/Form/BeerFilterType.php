<?php

// src/AppBundle/Form/BeerFilterType.php
namespace AppBundle\Form;

use AppBundle\Entity\Beer;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class BeerFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
             $builder
                 ->add('isAttending', ChoiceType::class, array(
                     'choices'  => array(
                         'Maybe',
                         'Yes',
                         'No',
                     )
                 ))
                 ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       /* $resolver->setDefaults(array(
            'data_class' => Beer::class,
        ));*/
    }
}