<?php

namespace App\Repository;

use App\Entity\RefPokemonType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RefPokemonType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefPokemonType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefPokemonType[] findAll()
 * @method RefPokemonType[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefPokemonTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefPokemonType::class);
    }
}
