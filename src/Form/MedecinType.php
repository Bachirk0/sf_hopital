<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;
use App\Repository\ServiceRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedecinType extends AbstractType
{
    private $serviceRecup;
    private $specialiteRecup;

    public function __construct(ServiceRepository $serviceRecup, SpecialiteRepository $specialiteRecup)
    {
        $this->serviceRecup = $serviceRecup;
        $this->specialiteRecup = $specialiteRecup;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('service', EntityType::class, [
                'class' => Service::class,
              'choices' => $this->serviceRecup->findAll()
            ])
            ->add('specialite', EntityType::class, [
                'class' => Specialite::class,
                'choices' => $this->specialiteRecup->findAll(),
                'multiple' => true 
            ])
            ->add('prenom')
            ->add('nom')
            ->add('date_de_naissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('telephone')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
