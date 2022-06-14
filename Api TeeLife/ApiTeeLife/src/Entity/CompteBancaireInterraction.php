<?php

namespace App\Entity;

use App\Repository\CompteBancaireInterractionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CompteBancaireInterractionRepository::class)]
class CompteBancaireInterraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: CompteBancaire::class, inversedBy: 'compteBancaireInterractions')]
    private $numero_cb;

    #[ORM\Column(type: 'bigint')]
    private $montant;

    #[ORM\Column(type: 'boolean')]
    private $negatif_ou_positif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCb(): ?CompteBancaire
    {
        return $this->numero_cb;
    }

    public function setNumeroCb(?CompteBancaire $numero_cb): self
    {
        $this->numero_cb = $numero_cb;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNegatifOuPositif(): ?bool
    {
        return $this->negatif_ou_positif;
    }

    public function setNegatifOuPositif(bool $negatif_ou_positif): self
    {
        $this->negatif_ou_positif = $negatif_ou_positif;

        return $this;
    }
}
