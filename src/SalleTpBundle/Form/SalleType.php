<?php
namespace SalleTpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('batiment')
                ->add('etage')
                ->add('numero');
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array (
            'data_class' => 'SalleTpBundle\Entity\Salle',
        ));
    }
}