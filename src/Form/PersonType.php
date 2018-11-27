<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Sex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('age')
            ->add('fathers')
            ->add('mothers')
            ->add('sexes', EntityType::class, [
  'class' => Sex::class, 
  'choice_label' => 'name', 
  'multiple' => true, 
  'expanded' => true
]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
