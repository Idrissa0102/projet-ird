<?php
namespace App\Controller\Form;

use App\Controller\Data\SearchType;
use App\Entity\TypeDocument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class SearchTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeDocuments', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => TypeDocument::class,
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchType::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]
        );
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
?>