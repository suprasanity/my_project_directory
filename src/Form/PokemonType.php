<?php

namespace App\Form;

use App\Repository\PokemonRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\FormBuilderInterface;

class PokemonType extends AbstractType
{
    private PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pokemon', ChoiceType::class, [
                'choices' => $this->pokemonRepository->findAll(),
                'choice_label' => 'name',
            ]);
    }
}