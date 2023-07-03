<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * RefElementaryType
 *
 * @ORM\Table(name="ref_elementary_type")
 * @ORM\Entity
 */
class RefElementaryType
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RefElementaryType
     */
    public function setId(int $id): RefElementaryType
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
     * @return RefElementaryType
     */
    public function setName(string $name): RefElementaryType
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


}
