<?php
namespace SalleTpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use SalleTpBundle\Repository\salleRepository;

class OrdinateurType3 extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('ip')
                ->add('numero')
                ->add('salle', SalleType::class); // Ajouter les 3 champs du formulaire de la salle:
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array (
            'data_class' => 'SalleTpBundle\Entity\Ordinateur',
        ));
    }
}