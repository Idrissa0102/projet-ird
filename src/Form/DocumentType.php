<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\MotClef;
use App\Repository\MotClefRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Test\FormInterface;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('resume', TextareaType::class )
            ->add('doi', TextType::class)
            ->add('dateProduction', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('licence', EntityType::class, array(
                'class' => 'App:Licence',
                'choice_label'=>'nom',
                
            ))
            
            ->add('commentaire', TextareaType::class)
            ->add('collaboration', TextType::class)
            
            
            ->add('refInterne', TextType::class)
            
            ->add('financement', TextType::class)
            ->add('auteurAjoute', TextType::class)
            ->add('affiliation', TextType::class)
            ->add('participants', TextType::class)
            ->add('fichier', FichierType::class)
            ->add('typeDocument', EntityType::class, array(
                'class' => 'App:TypeDocument',
                'choice_label'=>'nom'
                
            ))
            ->add('domaine', EntityType::class, array(
                'class' => 'App:Domaine',
                'choice_label'=>'nom',
                
            ))
            
            ->add('keywords', TextType::class)

            ->add('langue', EntityType::class, array(
                'class' => 'App:Langue',
                'choice_label'=>'nom',
                'multiple'=>false,
                
            ))

            

        ;
        
        

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
            // On récupère notre objet Document sous-jacent
            $document = $event->getData();
            if (null === $document) {
                return;
                }
        }
        );


        

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }

    
}
