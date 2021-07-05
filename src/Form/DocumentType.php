<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('resume')
            ->add('doi')
            ->add('dateProduction')
            ->add('licence')
            ->add('classification')
            ->add('commentaire')
            ->add('collaboration')
            ->add('urlLie')
            ->add('codeAnr')
            ->add('refInterne')
            ->add('projetsLies')
            ->add('financement')
            ->add('auteurAjoute')
            ->add('affiliation')
            ->add('fichier', FichierType::class)
            ->add('typeDocument')
            ->add('domaine')
            ->add('motClef')
            ->add('langue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
