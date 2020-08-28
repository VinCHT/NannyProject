<?php

namespace App\Form;

use App\Entity\Nanny;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NannyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('experience')
            ->add('price')
            ->add('statut', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('city', ChoiceType::class, [
                'choices' => $this->getChoices2()
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'require' => false,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('address')
            ->add('postal_code')
            ->add('occuppe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nanny::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Nanny::STATUT;
        $output = [];
        foreach($choices as $k => $v )
        {
            $output[$v] = $k;
        }
        return $output;
    }

    private function getChoices2()
    {
        $choices = Nanny::VILLE;
        $output = [];
        foreach($choices as $k => $v )
        {
            $output[$v] = $k;
        }
        return $output;
    }

}
