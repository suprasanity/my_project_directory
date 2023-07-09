<?php

namespace App\Entity;

use App\Repository\ZoneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZoneRepository::class)
 */
class Zone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Foret;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Montagne;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Ville;

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->Ville;
    }

    /**
     * @param mixed $Ville
     */
    public function setVille($Ville): void
    {
        $this->Ville = $Ville;
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Plage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Prairie;

    /**
     * @ORM\ManyToOne(targetEntity=RefElementaryType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isForet(): ?bool
    {
        return $this->Foret;
    }

    public function setForet(?bool $Foret): self
    {
        $this->Foret = $Foret;

        return $this;
    }

    public function isMontagne(): ?bool
    {
        return $this->Montagne;
    }

    public function setMontagne(?bool $Montagne): self
    {
        $this->Montagne = $Montagne;

        return $this;
    }

    public function isPlage(): ?bool
    {
        return $this->Plage;
    }

    public function setPlage(?bool $Plage): self
    {
        $this->Plage = $Plage;

        return $this;
    }

    public function isPrairie(): ?bool
    {
        return $this->Prairie;
    }

    public function setPrairie(?bool $Prairie): self
    {
        $this->Prairie = $Prairie;

        return $this;
    }

    public function getType(): ?RefElementaryType
    {
        return $this->type;
    }

    public function setType(?RefElementaryType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
