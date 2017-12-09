<?php

namespace AppBundle\Form;

use AppBundle\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CookingRecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',                   TextType::class)
            ->add('preparationTime',        IntegerType::class)
            ->add('cookingTime',            IntegerType::class)
            ->add('content',                TextareaType::class)
            ->add('ingredients',            EntityType::class, array(
                'class'        =>       'AppBundle:Ingredient',
                'choice_label' =>       'name',
                'multiple'     =>       'true',
            ))
            ->add('specialtyCountry',       EntityType::class, array(
                'class'        =>       'AppBundle:SpecialtyCountry',
                'choice_label' =>       'country',
            ))
            ->add('partOfMenu',            EntityType::class, array(
                'class'        =>       'AppBundle:PartOfMenu',
                'choice_label' =>       'type',
            ))
            ->add('image',                  ImageType::class, array (
                'required'     =>       'false',
            ))
            ->add('save',                   SubmitType::class, array('label' => 'Valider'))

        ;
        $builder->addEventListener(

            FormEvents::PRE_SET_DATA,

            function(FormEvent $event)
            {
                $cookingRecipe = $event->getData();


                // Si l'annonce n'est pas publiée, ou si elle n'existe pas encore en base
                // (id est null)
                if ( null !== $cookingRecipe->getId())
                {
                    // Alors on ajoute le champ published
                    $event->getForm()->add('published', CheckboxType::class, array('required'  => false));
                }
                else
                {
                    // Sinon, on le supprime
                    $event->getForm()->remove('published');
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CookingRecipe'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cooking_recipe';
    }
}
