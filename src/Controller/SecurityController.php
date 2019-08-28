<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Form\ModificationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController {

    /**
     * @Route("/connexion", name="security_login")
    */
    public function login(AuthenticationUtils $authenticationUtils) 
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'security/identification.html.twig', [
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        ]
        );
    }

    /**
     * @Route("/logout", name="security_logout")
    */
    public function logout() 
    {

    }


    /**
     * @Route("/interdit", name="interdit")
    */
    public function interdit() 
    {
        return $this->render('Access.html.twig');
    }

    /**
     * @Route("/inscription", name="security_registration")
    */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder)  
    {

        // 1) Générons le formulaire à partir de notre UserType
        $user = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $user);

        // 2) Traitement du formulaire une fois envoyé
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 3) sauvegarde de l'utilisateur en base de données!
            $manager->persist($user);
            $manager->flush();

            $repoU= $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::Class);

            $utilisateurs= $repoU->findAll();

            return $this->render('formulaire/eleve_liste.html.twig', ['controller_name' => 'Controller_Default',
            'utilisateurs'=> $utilisateurs 
            ]);
        }
        
        return $this->render('security/inscription.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route("/Modification/{id}", name="security_modification")
    */
    public function modification (Request $request, ObjectManager $manager, $id)  
    {

        // 1) Générons le formulaire à partir de notre UserType
        $user = $this->getDoctrine()->getrepository(\App\Entity\Utilisateur::Class)->find($id);
        $form = $this->createForm(ModificationType::class, $user);

        // 2) Traitement du formulaire une fois envoyé
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            // 3) sauvegarde de l'utilisateur en base de données!
            $manager->persist($user);
            $manager->flush();

            $repoU= $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::Class);

            $utilisateurs= $repoU->findAll();

            return $this->render('formulaire/eleve_liste.html.twig', ['controller_name' => 'Controller_Default',
            'utilisateurs'=> $utilisateurs 
            ]);
        }
        
        return $this->render('formulaire/eleve_modif.html.twig', ['form'=> $form->createView()]);
    }


    /**
     * @Route("/Suppression/{id}", name="Delete")
     */
    public function Delete(Request $request,$id)
    {
        $utilisateur = $this->getDoctrine()->getRepository(App\Entity\Utilisateur::Class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }


}
