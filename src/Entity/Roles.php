<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles 
{
    /**
     * @var int
     *
     * @ORM\Column(name="numRole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numrole;

    /**
     * @var string
     *
     * @ORM\Column(name="NomRole", type="string", length=20, nullable=false)
     */
    private $nomrole;

    /**
     * @var string
     *
     * @ORM\Column(name="Classe", type="string", length=50, nullable=false)
     */
    private $classe;

    public function getNumrole(): ?int
    {
        return $this->numrole;
    }

    public function getNomrole(): ?string
    {
        return $this->nomrole;
    }

    public function setNomrole(string $nomrole): self
    {
        $this->nomrole = $nomrole;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
    * @see \Serializable::serialize()
    */
    public function serialize() {
        return serialize(array(
            $this->numrole , $this->nomrole ,$this->classe
        ));
    }

    /**
    * @see \Serializable::unserialize()
    */
    public function unserialize($serialized) {
        list (
        $this->numrole, $this->nomrole, $this->classe
        ) = unserialize($serialized);
    }

    public function __toString()
{
    try{
        return (string) $this->getClasse();
    }

    catch (Exeption $exeption)
    {
        return '';
    }
}


}
