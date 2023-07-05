<?php

namespace App\Form;

use App\Entity\RefPokemonType;
use App\Repository\RefPokemonTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PokemonType extends AbstractType
{
    private RefPokemonTypeRepository $pokemonRepository;

    public function __construct(RefPokemonTypeRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $Pokemons = $this->pokemonRepository->findAll();
        //add $Pokemons object to the form
        $builder->add('pokemon', ChoiceType::class, [
            'choices' => $Pokemons,
            'choice_label' => function(?RefPokemonType $pokemon) {
                return $pokemon ? $pokemon->getName() : '';
            },
            'choice_value' => function(?RefPokemonType $pokemon) {
                return $pokemon ? $pokemon->getId() : '';
            },
            'placeholder' => 'Choose a Pokemon',
            'required' => true,
        ]);
    }
}
