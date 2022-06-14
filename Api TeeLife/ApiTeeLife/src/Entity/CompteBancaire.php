<?php

namespace App\Entity;

use App\Repository\CompteBancaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CompteBancaireRepository::class)]
class CompteBancaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'compteBancaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_personnage;

    #[ORM\ManyToOne(targetEntity: Banque::class, inversedBy: 'compteBancaires')]
    private $id_banque;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $solde;

    #[ORM\OneToMany(mappedBy: 'numero_cb', targetEntity: CompteBancaireInterraction::class)]
    private $compteBancaireInterractions;

    public function __construct()
    {
        $this->compteBancaireInterractions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersonnage(): ?Personnage
    {
        return $this->id_personnage;
    }

    public function setIdPersonnage(?Personnage $id_personnage): self
    {
        $this->id_personnage = $id_personnage;

        return $this;
    }

    public function getIdBanque(): ?Banque
    {
        return $this->id_banque;
    }

    public function setIdBanque(?Banque $id_banque): self
    {
        $this->id_banque = $id_banque;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection<int, CompteBancaireInterraction>
     */
    public function getCompteBancaireInterractions(): Collection
    {
        return $this->compteBancaireInterractions;
    }

    public function addCompteBancaireInterraction(CompteBancaireInterraction $compteBancaireInterraction): self
    {
        if (!$this->compteBancaireInterractions->contains($compteBancaireInterraction)) {
            $this->compteBancaireInterractions[] = $compteBancaireInterraction;
            $compteBancaireInterraction->setNumeroCb($this);
        }

        return $this;
    }

    public function removeCompteBancaireInterraction(CompteBancaireInterraction $compteBancaireInterraction): self
    {
        if ($this->compteBancaireInterractions->removeElement($compteBancaireInterraction)) {
            // set the owning side to null (unless already changed)
            if ($compteBancaireInterraction->getNumeroCb() === $this) {
                $compteBancaireInterraction->setNumeroCb(null);
            }
        }

        return $this;
    }
}
