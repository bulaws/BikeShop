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
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class)
            ->add('priceFrom', TextType::class)
            ->add('priceTo', TextType::class)
            ->add('price',ChoiceType::class, [
                    'choices' => [
                        'increase' => 'asc',
                        'decrease' => 'desc',
                  ]], ['attr' => ['class' => 'form-control']])
            ->add('save', SubmitType::class, [
                'label' => 'Зберегти',
                'attr' => ['class' => 'btn btn-primary mt-2'] ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                'data_class' => Filter::class,
            ]);
    }
}