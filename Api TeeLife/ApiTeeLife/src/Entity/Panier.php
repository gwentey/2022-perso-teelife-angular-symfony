<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:panier'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Magasin::class, inversedBy: 'paniers')]
    #[Groups(['get:panier'])]
    private $id_magasin;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'paniers')]
    #[Groups(['get:panier'])]
    private $id_personnage;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['get:panier'])]
    private $payer;

    #[ORM\OneToMany(mappedBy: 'id_panier', targetEntity: CompositionPanier::class)]
    #[Groups(['get:panier'], ['get:composition_seulement'])]
    private $compositionPaniers;

    public function __construct()
    {
        $this->compositionPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMagasin(): ?Magasin
    {
        return $this->id_magasin;
    }

    public function setIdMagasin(?Magasin $id_magasin): self
    {
        $this->id_magasin = $id_magasin;

        return $this;
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

    public function getPayer(): ?bool
    {
        return $this->payer;
    }

    public function setPayer(bool $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * @return Collection<int, CompositionPanier>
     */
    public function getCompositionPaniers(): Collection
    {
        return $this->compositionPaniers;
    }

    public function addCompositionPanier(CompositionPanier $compositionPanier): self
    {
        if (!$this->compositionPaniers->contains($compositionPanier)) {
            $this->compositionPaniers[] = $compositionPanier;
            $compositionPanier->setIdPanier($this);
        }

        return $this;
    }

    public function removeCompositionPanier(CompositionPanier $compositionPanier): self
    {
        if ($this->compositionPaniers->removeElement($compositionPanier)) {
            // set the owning side to null (unless already changed)
            if ($compositionPanier->getIdPanier() === $this) {
                $compositionPanier->setIdPanier(null);
            }
        }

        return $this;
    }
}
