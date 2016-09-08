<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="login", message="Login already taken")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(min=3, max=255)
     * @Assert\NotBlank()
     */
    private $login = '';

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min=6, max=255)
     */
    private $password = '';

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword = '';

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255)
     */
    private $firstname = '';

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255)
     */
    private $lastname = '';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     mimeTypes={"image/jpeg", "image/png"}
     * )
     */
    private $avatar;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }


    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }


    /**
     * @return string
     */
    public function getFirstname() : string
    {
        return $this->firstname;
    }


    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }


    /**
     * @return string
     */
    public function getLastname() : string
    {
        return $this->lastname;
    }


    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }


    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }


    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->login;
    }


    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
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
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password      = null;
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}