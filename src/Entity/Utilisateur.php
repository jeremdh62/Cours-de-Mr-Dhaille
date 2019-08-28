<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;




/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="numRoles", columns={"numRoles"})})
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=100, nullable=false)
     */
    private $mdp;

    public $confirm_mdp;

    /**
     * @var \Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numRoles", referencedColumnName="numRole")
     * })
     */
    private $numroles;


    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
      return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getNumroles(): ?Roles
    {
        return $this->numroles;
    }

    public function setNumroles(Roles $numroles): self
    {
        $this->numroles = $numroles;

        return $this;
    }

    /**
    * @see \Serializable::serialize()
    */
    public function serialize() {
        return serialize(array(
            $this->id, $this->nom, $this->mdp, $this->mail
        ));
    }

    /**
    * @see \Serializable::unserialize()
    */
    public function unserialize($serialized) {
        list (
        $this->id, $this->nom, $this->mdp, $this->mail
        ) = unserialize($serialized);
    }

    public function getRoles() {

    return array( 0 =>$this->numroles->getNomrole());
    }

    public function getSalt(){
      return "";
    }

    public function getUsername(){

      return $this->mail;
    }

    public function eraseCredentials() {

  }

  public function getPassword(): string
  {
      return $this->mdp;
  }

  public function setPassword(string $mdp): self
  {
      $this->mdp = $mdp;

      return $this;
  }

}
