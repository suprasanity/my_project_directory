<?php

namespace App\Repository;

use App\Entity\Trainer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trainer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trainer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trainer[]    findAll()
 * @method Trainer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trainer::class);
    }
    /**
     * Find a Trainer by ID.
     *
     * @param int $id
     * @return Trainer
     */
    public function findById(int $id): Trainer
    {
        return $this->find($id);
    }


    public function persist(?Trainer $Trainer)
    {
        if ($Trainer) {
            $this->_em->persist($Trainer);
            $this->_em->flush();
        }
    }


}
