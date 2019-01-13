<?php
namespace SalleTpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use SalleTpBundle\Repository\salleRepository;

class OrdinateurType2 extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('ip')
                ->add('numero')
                ->add('salle', EntityType::class, array( 'class' =>'SalleTpBundle:Salle',
                    'query_builder' =>function (salleRepository $rep){
                        return $rep->createQueryBuilder('s')
                                   ->where('s.etage<=1')
                                   ->orderBy('s.numero', 'ASC');
                    }
                ) );
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array (
            'data_class' => 'SalleTpBundle\Entity\Ordinateur',
        ));
    }
}