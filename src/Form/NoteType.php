<?php

// src/Form/NoteType.php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Note;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Ajoutez les champs du formulaire en fonction de votre entité Note
            ->add('Note')
            ->add('dateAjout')
            ->add('Matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'nom',
            ])
            ->add('coefMatiere')

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
