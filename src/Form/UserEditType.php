<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{

    public function getParent(){
        return  UserType::class;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('password')
            ->remove('passwordConfirm')
            ->remove('isVerified')
            ->remove('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
