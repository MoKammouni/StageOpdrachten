<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=School::class, mappedBy="Niveau")
     */
    private $Niveau_id;

    public function __construct()
    {
        $this->Niveau_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|School[]
     */
    public function getNiveauId(): Collection
    {
        return $this->Niveau_id;
    }

    public function addNiveauId(School $niveauId): self
    {
        if (!$this->Niveau_id->contains($niveauId)) {
            $this->Niveau_id[] = $niveauId;
            $niveauId->setNiveau($this);
        }

        return $this;
    }

    public function removeNiveauId(School $niveauId): self
    {
        if ($this->Niveau_id->removeElement($niveauId)) {
            // set the owning side to null (unless already changed)
            if ($niveauId->getNiveau() === $this) {
                $niveauId->setNiveau(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->getName();
    }
}
