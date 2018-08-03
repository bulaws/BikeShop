<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Text', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('Author', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Save', SubmitType::class, [
                'label' => 'Зберегти',
                'attr' => ['class' => 'btn btn-primary mt-2'] ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => 'App\Entity\Article',
        ]);
    }

}