<?php

namespace App\Form;


use App\Model\Filter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FilterType extends AbstractType
{
    public function buildFilterForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('search', SearchType::class)
            ->add('priceFrom', TextType::class)
            ->add('priceTo', TextType::class)
            ->add('Price',ChoiceType::class, [
                'choices' => [
                    'increase' => 'asc',
                    'decrease' => 'desc',
                  ]])
            ->add('save', SubmitType::class, [
                'label' => 'Save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
        ]);
    }
}