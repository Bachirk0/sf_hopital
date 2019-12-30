<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecin.show")
     */
    public function showMedecin(MedecinRepository $repos )
    {
        $medecin =$repos->findAll();
         
        return $this->render('medecin/index.html.twig', [
            'medecin' =>$medecin,
        ]);
    }

     /**
     * @Route("/medecin/add", name="medecin.add")
     */
    public function addMedecin(Request $request )
    {
        $medecin = new Medecin();
        // ...

        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
        
             $entityManager->persist($medecin);
             $entityManager->flush();
    
            return $this->redirectToRoute('medecin.show');
        }
    
        return $this->render('medecin/formMed.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

    /**
     * @Route("/medecin/edit/{id}", name="medecin.edit")
     */
    public function editMedecin( $id ,Request $request,MedecinRepository $repos  )
    {
        $medecin = $repos->find($id);
        // ...

        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($medecin);
             $entityManager->flush();
    
            return $this->redirectToRoute('medecin.show');
        }
    
        return $this->render('medecin/formMed.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

    /**
     * @Route("/medecin/delete/{id}", name="medecin.delete")
     */
    public function deleteMedecin( $id ,MedecinRepository $repos  )
    {
        $medecin = $repos->find($id);
       
        $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($medecin);
             $entityManager->flush();
    
            return $this->redirectToRoute('medecin.show');
    }

}
