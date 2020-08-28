<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OperationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"read"})
     */
    private $dateOperation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOperation::class, inversedBy="compte")
     */
    private $typeOperation;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="operations")
     */
    private $compte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateOperation(): ?string
    {
        return $this->dateOperation;
    }

    public function setDateOperation(string $dateOperation): self
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    public function getTypeOperation(): ?TypeOperation
    {
        return $this->typeOperation;
    }

    public function setTypeOperation(?TypeOperation $typeOperation): self
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
