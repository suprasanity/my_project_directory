<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * RefPokemonType
 *
 * @ORM\Table(name="ref_pokemon_type", indexes={@ORM\Index(name="FK_trainer_id", columns={"trainer_id"}), @ORM\Index(name="FK_type_2", columns={"type_2"}), @ORM\Index(name="FK_type_1", columns={"type_1"})})
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
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RefPokemonType
     */
    public function setId(int $id): RefPokemonType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RefPokemonType
     */
    public function setName(string $name): RefPokemonType
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastTrained(): ?\DateTime
    {
        return $this->lastTrained;
    }

    /**
     * @param \DateTime|null $lastTrained
     * @return RefPokemonType
     */
    public function setLastTrained(?\DateTime $lastTrained): RefPokemonType
    {
        $this->lastTrained = $lastTrained;
        return $this;
    }

    /**
     * @return \RefElementaryType
     */
    public function getType2(): \RefElementaryType
    {
        return $this->type2;
    }

    /**
     * @param \RefElementaryType $type2
     * @return RefPokemonType
     */
    public function setType2(\RefElementaryType $type2): RefPokemonType
    {
        $this->type2 = $type2;
        return $this;
    }

    /**
     * @return \Trainer
     */
    public function getTrainer(): \Trainer
    {
        return $this->trainer;
    }

    /**
     * @param \Trainer $trainer
     * @return RefPokemonType
     */
    public function setTrainer(\Trainer $trainer): RefPokemonType
    {
        $this->trainer = $trainer;
        return $this;
    }

    /**
     * @return \RefElementaryType
     */
    public function getType1(): \RefElementaryType
    {
        return $this->type1;
    }

    /**
     * @param \RefElementaryType $type1
     * @return RefPokemonType
     */
    public function setType1(\RefElementaryType $type1): RefPokemonType
    {
        $this->type1 = $type1;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_trained", type="datetime", nullable=true)
     */
    private $lastTrained;

    /**
     * @var \RefElementaryType
     *
     * @ORM\ManyToOne(targetEntity="RefElementaryType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_2", referencedColumnName="id")
     * })
     */
    private $type2;

    /**
     * @var \Trainer
     *
     * @ORM\ManyToOne(targetEntity="Trainer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trainer_id", referencedColumnName="id")
     * })
     */
    private $trainer;

    /**
     * @var \RefElementaryType
     *
     * @ORM\ManyToOne(targetEntity="RefElementaryType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_1", referencedColumnName="id")
     * })
     */
    private $type1;


}
