<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Evenement pour rendre obligatoire l'ajout d'image si on édite une entité
        $builder->addEventListener(

            FormEvents::PRE_SET_DATA,

            function(FormEvent $event)
            {
                $image = $event->getData();

                if (null === $image)
                {
                    return;
                }

                // Si il y a pas encore d'image alors on ajoute le formulaire obligatoire
                if ( null === $image->getId())
                {
                    // Alors on ajoute le champ published
                    $event->getForm()->add('file', FileType::class);
                }
                // Sinon, on rend le champ pas obligatoire
                else
                {
                    // Sinon, on le supprime
                    $event->getForm()->add('file', FileType::class, array('required'   => false));
                }
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_image';
    }


}
