<?php

namespace SalleTpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SalleTpBundle\Entity\Salle;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Common\Util\Debug;
use SalleTpBundle\Entity\Ordinateur;

class EssaiController extends Controller
{
    public function test1Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $salle= new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(70);
        $entityManager->persist($salle);
            $result = 'persist ----'.$salle.'id: '.$salle->getId().'<br/>';
        $entityManager->flush();
            $result .= 'flush ---- id: '.$salle->getId().'<br/>';
        $repositorySalle = $entityManager->getRepository('SalleTpBundle:Salle');
        $salle2 = $repositorySalle->find($salle->getId());
        if ($salle2 !== null)
            $result .= 'find('.$salle->getId().') ---'.$salle2;
        return new Response ('<html><body>'.$result.'</body></html>');
    }
    
    public function test2Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(73);
        $entityManager->persist($salle);
        $salle->setNumero($salle->getNumero()+1);
        $entityManager->flush();
        $repositorySalle = $entityManager->getRepository('SalleTpBundle:Salle');
        $salle2 = $repositorySalle->find($salle->getId());
        return new Response('<html><body>'.$salle2.'</body></html>');
    }
    
    public function test3Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(75);
        $entityManager->persist($salle);
        $result = 'persist '.$salle.'<br/>';
        $entityManager->flush();
        $id = $salle->getId();
        $result .= 'flush ----  id: '.$id.'</br>';
        $repositorySalle =$entityManager->getRepository('SalleTpBundle:Salle');
        $salle = $repositorySalle->find($id);
        $result .= 'find('.$id.') --- Salle:'.$salle.'</br>';
        $entityManager->remove($salle);
        $entityManager->flush();
        $result .= 'remove salle puis flush</br>';
        $result .= 'find('.$id.')='.$repositorySalle->find($id).'</br>';
        $result .= 'contains(salle):'.$entityManager->contains($salle);
        return new Response("<html><body>$result</body></html>");

    }
    
    
    public function test4Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(76);
        $entityManager->persist($salle);
        $result = 'persist '.$salle.'<br/>';
        $entityManager->flush();
        $id = $salle->getId();
        $result .= 'flush id: '.$id.' --contains: '
            .$entityManager->contains($salle).'</br>';
            $entityManager->clear();
            $result .= 'clear --- contains: '.$entityManager->contains($salle).'</br>';
            $repositorySalle = $entityManager->getRepository('SalleTpBundle:Salle');
            $salle = $repositorySalle->find($id);
            $result .='find('.$id.') --- contains (cette salle):'
                .$entityManager->contains($salle).'</br>';
                return new Response('<html><body>'.$result.'</body></html>');
        
    }
    
    public function test6Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $salle = $repository->find(1);
        //var_dump($salle);
        //Afiichage plus lisible
        Debug::dump($salle);
        return new Response('<html></body></body></html>');
    }
    
    public function test7Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->findAll();
        return $this->render('@SalleTp/Salle/liste.html.twig',
            array('listeSalles' => $listeSalles));
    }
    
    public function test8Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->findBy(array('etage' => 1),
                                        array('numero' =>'asc'),2,1);
        return $this->render('@SalleTp/Salle/liste.html.twig',
                              array('listeSalles' => $listeSalles));    
    }
    
    public function test9Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $salle = $repository->findOneBy(array('etage'=>1));
        return new Response("<html><body>".$salle."</body></html>");
        
    }
    
    public function test10Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->findByBatiment('B');
        return $this->render('@SalleTp/Salle/liste.html.twig',
            array('listeSalles' => $listeSalles)); 
    }
    
    public function test11Action(){
        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('SalleTpBundle:Salle');
        $salle = $repository->findOneByEtage(1);
        return new Response("<html><body>".$salle."</body></html>");
    }
    
    public function test12Action(){
        $repository = $this->getDoctrine()
                           ->getEntityManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->findByBatimentAndEtageMax('D',6);
        return $this->render('@SalleTp/Salle/liste.html.twig',
            array('listeSalles' => $listeSalles));
    }
    
    public function test13Action(){
        $repository = $this->getDoctrine()
                           ->getEntityManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->findSalleBatAouB();
        return $this->render('@SalleTp/Salle/liste.html.twig',
            array('listeSalles' => $listeSalles));
    }
    
    public function test14Action(){
        $repository = $this->getDoctrine()
                           ->getEntityManager()
                           ->getRepository('SalleTpBundle:Salle');
        $listeSalles = $repository->plusUnEtage();
        return new Response('<html><body><a href="http://localhost/phpmyadmin">Voir phpmyadmin</a></body></html>');
    }
    
    public function test16Action(){
        $repository = $this->getDoctrine()
                           ->getEntityManager()
                           ->getRepository('SalleTpBundle:Salle');
        $result = $repository->testGetResult();
        Debug::dump($result);
        return new Response  ('<html><body></body></html>');
    }
    
    
    public function test19Action(){
        $repository = $this->getDoctrine()
                           ->getRepository('SalleTpBundle:Salle');
        $result = $repository->testGetSingleScalarResult();
        Debug::dump($result);
        return new Response('<html><body></body></html>');
    }
    
    public function test23Action(){
        $entityManager = $this->getDoctrine()
                              ->getManager();
        $salle= new Salle;
        $salle->setBatiment('b'); //minuscule !
        $salle->setEtage(3);
        $salle->setNumero(63);
        $entityManager->persist($salle);
        $entityManager->flush();
        return $this->redirectToRoute('salle_tp_voir2',
                                        array('id' => $salle->getId()));  
    }
    
    public function test25Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(702);
        $ordi->setIp('192.168.7.02');
        $repository = $this->getDoctrine()->getManager()->getRepository('SalleTpBundle:Salle');
        $salle = $repository->findOneBy(array('batiment'=>'B','etage' =>3,'numero' =>63));
        $ordi->setSalle($salle);
        $entityManager->persist($ordi);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test26Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(701);
        $ordi->setIp('192.168.7.01');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(01);
        $ordi->setSalle($salle);
        $entityManager->persist($ordi);
        $entityManager->persist($salle);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test27Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(701);
        $ordi->setIp('192.168.7.03');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(03);
        $ordi->setSalle($salle);
        $entityManager->persist($ordi);
        //$entityManager->persist($salle);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test28Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryOrdinateur = $entityManager->getRepository('SalleTpBundle:Ordinateur');
        $ordi = $repositoryOrdinateur->findOneByNumero(702);
        return new Response('<html><body><br><br> Batiment: '.$ordi->getSalle()->getBatiment().'</body></html>');
        
    }
    
    public function test29Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(803);
        $ordi->setIp('192.168.8.03');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(8);
        $salle->setNumero(03);
        $salle->addOrdinateur($ordi);
        $entityManager->persist($ordi);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test30Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(804);
        $ordi->setIp('192.168.8.04');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(8);
        $salle->setNumero(04);
        $ordi->setSalle($salle);
        $entityManager->persist($ordi);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test31Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $ordi = new Ordinateur;
        $ordi->setNumero(807);
        $ordi->setIp('192.168.8.07');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(8);
        $salle->setNumero(07);
        $salle->addOrdinateur($ordi);
        $entityManager->persist($ordi);
        $entityManager->flush();
        debug::dump($ordi);
        return new Response("<html><body></body></html>");
    }
    
    public function test32Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryOrdinateur = $entityManager->getRepository('SalleTpBundle:Ordinateur');
        $ordi = $repositoryOrdinateur->findOneByNumero(807);
        $ordi2 = new Ordinateur;
        $ordi2->setNumero(808);
        $ordi2->setIp('192.168.8.08');
        $ordi2->setSalle($ordi->getSalle());
        $entityManager->persist($ordi2);
        $id = $ordi->getSalle()->getId();
        $entityManager->flush();
        $entityManager->clear();
        $repositorySalle = $entityManager->getRepository('SalleTpBundle:Salle');
        $salle = $repositorySalle->find($id);
        $result = "";
        foreach ($salle->getOrdinateurs() as $ordi)
            $result .=$ordi->getIp().' ';
        return new Response('<html><body>'.$result.'</body></html>');
    }
    
    public function test34Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryOrdinateur = $entityManager->getRepository('SalleTpBundle:Ordinateur');
        $ordi = $repositoryOrdinateur->findOneByNumero(808);
        $entityManager->remove($ordi);
        $entityManager->flush();
        return new Response("<html><body></body></html>");
    }
    
    public function test35Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryOrdinateur = $entityManager->getRepository('SalleTpBundle:Ordinateur');
        $ordi = new Ordinateur;
        $ordi->setNumero(901);
        $ordi->setIp('192.168.9.01');
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(9);
        $salle->setNumero(01);
        $ordi->setSalle($salle);
        $entityManager->persist($ordi);
        $entityManager->flush();
        $idOrdi = $ordi->getId();
        $entityManager->remove($ordi->getSalle());
        $entityManager->flush();
        return new Response('<html><body>'.$result.'</body></html>');
    }
    
    
    public function test37Action(){
        $entityManager = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(9);
        $salle->setNumero(04);
        $ordi1 = new Ordinateur;
        $ordi1->setNumero(904);
        $ordi1->setIp('192.168.9.04');
        $entityManager->persist($ordi1);
        $ordi1->setSalle($salle);
        $ordi2 = new Ordinateur;
        $ordi2->setNumero(905);
        $ordi2->setIp('192.168.9.05');
        $entityManager->persist($ordi2);
        $ordi2->setSalle($salle);
        $entityManager->flush();
        $idSalle = $salle->getId();
        $entityManager->flush();
        $entityManager->clear();
        
        $repositorySalle = $entityManager->getRepository('SalleTpBundle:Salle');
        $salle =$repositorySalle->find($idSalle);
        $entityManager->remove($salle);
        $entityManager->flush();
        return new Response('<html><body>rechercher la salle D­9.04 
                        puis les ordis 904 et 905 avec PhpMyAdmin<</body></html>');
    }
    
    
}