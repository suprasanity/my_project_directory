<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trainer
 *
 * @ORM\Table(name="trainer")
 * @ORM\Entity
 * @method string getUserIdentifier()
 */
class Trainer implements \Symfony\Component\Security\Core\User\UserInterface
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
     * @return Trainer
     */
    public function setId(int $id): Trainer
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
     * @return Trainer
     */
    public function setName(string $name): Trainer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return Trainer
     */
    public function setPassword(?string $password): Trainer
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Trainer
     */
    public function setEmail(?string $email): Trainer
    {
        $this->email = $email;
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
    private string $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private ?string $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstLogged", type="boolean", nullable=false)
     */
    private bool $firstLogged;

    /**
     * @return bool
     */
    public function isFirstLogged(): bool
    {
        return $this->firstLogged;
    }

    /**
     * @param bool $firstLogged
     * @return Trainer
     */
    public function setFirstLogged(bool $firstLogged): Trainer
    {
        $this->firstLogged = $firstLogged;
        return $this;
    }


    public function getRoles(): array
    {
     return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getUsername()
    {
       return $this->name;
    }

    public function __call($name, $arguments)
    {
        return null;

    }
}
