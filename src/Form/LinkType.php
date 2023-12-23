<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'label' => 'Titre',
            ])
            ->add('url', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'label' => 'URL',
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'label' => 'Description',
            ])
            ->add('state', CheckboxType::class, [
                'attr' => ['class' => 'mb-2 checkboxForm form-check-input'],
                'label' => 'État',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
