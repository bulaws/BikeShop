<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("userName",message="Username exist")
 * @UniqueEntity("email",message="Email exist")
 */

class User implements UserInterface, Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $password;

    private $plainPassword;

    public function getId()
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->userName,
            $this->password,
        ]);
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->userName,
            $this->password
            ) = unserialize($serialized);
    }
    public function getRoles()
    {
        return [
            'ROLE_USER',
        ];
    }
    public function getSalt()
    {
        return null;
    }
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
