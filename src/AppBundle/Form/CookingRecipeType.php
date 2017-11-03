<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ->add('image',                  FileType::class, array (
                'required'     =>       'false',
            ))
            ->add('save',                   SubmitType::class, array('label' => 'Valider'))

        ;
    }
}
