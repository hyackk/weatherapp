<?php

namespace App\Form;

use App\Entity\Weather;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('time')
            ->add('pressure')
            ->add('visibility')
            ->add('wind_speed')
            ->add('wind_deg')
            ->add('clouds')
            ->add('humidity')
            ->add('temp_max')
            ->add('temp_min')
            ->add('temp_avg')
            ->add('weather_description')
            ->add('weather_name')
            ->add('timezone')
            ->add('location', EntityType::class, [
                'class'=> Location::class,
                'choice_label' => 'city',
                'choice_value' => 'id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
