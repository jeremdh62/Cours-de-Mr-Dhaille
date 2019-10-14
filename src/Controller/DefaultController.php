<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="default")
     */
    public function index() {
        return $this->render('index.html.twig');
    }
    
    /**
     * @Route("/lienSite", name="lienSite")
     */
    public function lienSite()  {
        return $this->render('lien_site.html.twig');
    }

    /**
     * @Route("/eleves", name="eleves")
     */
    public function lUtilisateur()  {

        $repoU = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::Class);
        $utilisateurs = $repoU->findByNotAdmin();

        return $this->render('formulaire/eleve_liste.html.twig',[
            'controller_name' => 'Controller_Default',
            'utilisateurs' =>$utilisateurs
        ]);
    }
    
    
     
   

}
