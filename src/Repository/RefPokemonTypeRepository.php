<?php

namespace App\Repository;

use App\Entity\RefPokemonType;
use App\Entity\Trainer;
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

    //find all pokemon where starter is true
    public function findAllStarters()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.starter = true')
            ->andWhere('p.trainer IS NULL')
            ->getQuery()
            ->getResult()
        ;
    }
    //

    public function findAllPokemonFromUser(string $userId)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.trainer', 't')
            ->where('t.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

    public function persist(?RefPokemonType $pokemon)
    {
        if ($pokemon) {
            $this->_em->persist($pokemon);
            $this->_em->flush();
        }
    }
    /**
     * Find a Pokemon by ID.
     *
     * @param int $id
     * @return RefPokemonType
     */
    public function findById(int $id): RefPokemonType
    {
        return $this->find($id);
    }

    public function findByTrainer(\App\Entity\Trainer $Trainer)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.trainer = :trainer')
            ->setParameter('trainer', $Trainer)
            ->getQuery()
            ->getResult();
    }

    public function delete(RefPokemonType $pokemon)
    {
        $this->_em->remove($pokemon);
        $this->_em->flush();
    }

    public function findPokemonToBuy(Trainer $Trainer)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.trainer IS not NULL')
            ->andWhere('p.sellPrice != 0')
            ->andWhere('p.trainer != :trainer')
            ->setParameter('trainer', $Trainer)
            ->getQuery()
            ->getResult();
    }

    public function findPokemonByType(array $typeIds): array
    {
        $queryBuilder = $this->createQueryBuilder('pokemon')
            ->select('pokemon.id')
            ->Where('pokemon.trainer IS NULL')
            ->andWhere('pokemon.type1 IN (:typeIds) OR pokemon.type2 IN (:typeIds)')
            ->setParameter('typeIds', $typeIds)
            ->groupBy('pokemon.id');

        $results = $queryBuilder->getQuery()->getScalarResult();

        return array_column($results, 'id');
    }


}
