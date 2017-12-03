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
        // Evenement pour rendre obligatoire l'ajout d'image quand on crée une entité
        $builder->addEventListener(

            FormEvents::PRE_SET_DATA,

            function(FormEvent $event)
            {
                $image = $event->getData();
                // Si il n'y a pas encore d'image on le rend obligtoire
                if (null === $image)
                {
                    $event->getForm()->add('file', FileType::class);
                }

                // Sinon, on rend le champ pas obligatoire
                else
                {
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
