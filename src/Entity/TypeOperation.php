<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeOperationRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeOperationRepository::class)
 */
class TypeOperation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("comptes")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("comptes")
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="typeOperation")
     */
    private $operation;

    public function __construct()
    {
        $this->operation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperation(): Collection
    {
        return $this->operation;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operation->contains($operation)) {
            $this->operation[] = $operation;
            $operation->setTypeOperation($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operation->contains($operation)) {
            $this->operation->removeElement($operation);
            // set the owning side to null (unless already changed)
            if ($operation->getTypeOperation() === $this) {
                $operation->setTypeOperation(null);
            }
        }

        return $this;
    }
}
