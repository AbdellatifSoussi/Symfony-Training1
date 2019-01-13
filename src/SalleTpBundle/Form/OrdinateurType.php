<?php
namespace SalleTpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrdinateurType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('ip')
                ->add('numero')
                ->add('salle', EntityType::class, array( 'class' =>'SalleTpBundle:Salle' ) );
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array (
            'data_class' => 'SalleTpBundle\Entity\Ordinateur',
        ));
    }
}