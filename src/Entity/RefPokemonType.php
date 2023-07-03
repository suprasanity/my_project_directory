<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * RefPokemonType
 *
 * @ORM\Table(name="ref_pokemon_type")
 * @ORM\Entity
 */
class RefPokemonType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="last_trained", type="datetime", nullable=true)
     */
    private ?DateTime $lastTrained;

    /**
     * @var RefElementaryType|null
     *
     * @ORM\ManyToOne(targetEntity="RefElementaryType")
     * @ORM\JoinColumn(name="type_1", referencedColumnName="id")
     */
    private ?RefElementaryType $type1;

    /**
     * @var RefElementaryType|null
     *
     * @ORM\ManyToOne(targetEntity="RefElementaryType")
     * @ORM\JoinColumn(name="type_2", referencedColumnName="id")
     */
    private ?RefElementaryType $type2;

    /**
     * @var Trainer|null
     *
     * @ORM\ManyToOne(targetEntity="Trainer")
     * @ORM\JoinColumn(name="trainer_id", referencedColumnName="id")
     */
    private ?Trainer $trainer;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastTrained(): ?DateTime
    {
        return $this->lastTrained;
    }

    public function setLastTrained(?DateTime $lastTrained): void
    {
        $this->lastTrained = $lastTrained;
    }

    public function getType1(): ?RefElementaryType
    {
        return $this->type1;
    }

    public function setType1(?RefElementaryType $type1): void
    {
        $this->type1 = $type1;
    }

    public function getType2(): ?RefElementaryType
    {
        return $this->type2;
    }

    public function setType2(?RefElementaryType $type2): void
    {
        $this->type2 = $type2;
    }

    public function getTrainer(): ?Trainer
    {
        return $this->trainer;
    }

    public function setTrainer(?Trainer $trainer): void
    {
        $this->trainer = $trainer;
    }
}
