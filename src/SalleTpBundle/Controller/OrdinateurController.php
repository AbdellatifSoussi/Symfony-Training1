<?php

namespace SalleTpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SalleTpBundle\Entity\Ordinateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class OrdinateurController extends Controller
{
    /**
     * @Route("/ordi/lister")
     */
    public function listerAction()
    {
        $em =  $this->getDoctrine()->getManager();
        $ordinateurs = $em->getRepository('SalleTpBundle:Ordinateur')->findAll();
        return $this->render('@SalleTp/Ordinateur/lister.html.twig', array('ordinateurs' => $ordinateurs
        ));
    }
    
    public function ajouterAction(Request $request){
        $ordinateur = new Ordinateur();
        $form = $this->createForm('SalleTpBundle\Form\OrdinateurType3',$ordinateur);
        $form->add('submit', SubmitType::class, array('label' =>'Ajouter'));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ordinateur);
            $em->flush();
            return $this->redirectToRoute('ordinateur_tp_lister');
        }
        return $this->render('@SalleTp/Ordinateur/ajouter.html.twig', array('monForm' => $form->createView()));
    }
}
