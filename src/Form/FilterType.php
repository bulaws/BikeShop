<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Model\Filter;

class FilterType extends AbstractType
{
    public function buildFilterForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', SearchType::class, ['label' => 'search'])
            ->add('priceFrom', TextType::class, ['label' => 'priceFrom'])
            ->add('priceTo', TextType::class, ['label' => 'priceTo'])
            ->add('Price',ChoiceType::class, [
                'choices' => [
                    'increase' => 'asc',
                    'decrease' => 'desc',
                  ], 'choices_as_values' => true,'multiple'=>false,'expanded'=>true])
            ->add('save', SubmitType::class, [
                'label' => 'Зберегти',
                'attr' => ['class' => 'btn btn-primary mt-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
        ]);
    }
}