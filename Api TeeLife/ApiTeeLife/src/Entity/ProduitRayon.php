<?php

namespace App\Entity;

use App\Repository\ProduitRayonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ProduitRayonRepository::class)]
class ProduitRayon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:panier', 'get:composition_seulement', 'get:rayon_by_magasin'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'produitRayons')]
    #[Groups(['get:rayon_by_magasin','get:panier', 'get:composition_seulement'])]
    private $id_produit;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:rayon_by_magasin'])]
    private $quantite;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['get:rayon_by_magasin','get:panier', 'get:composition_seulement'])]
    private $prix;

    #[ORM\ManyToOne(targetEntity: RayonMagasin::class, inversedBy: 'produitRayons')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_rayon;

    #[ORM\OneToMany(mappedBy: 'id_produitRayon', targetEntity: CompositionPanier::class)]
    private $compositionPaniers;


    public function __construct()
    {
        $this->compositionPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produit $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdRayon(): ?RayonMagasin
    {
        return $this->id_rayon;
    }

    public function setIdRayon(?RayonMagasin $id_rayon): self
    {
        $this->id_rayon = $id_rayon;

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
            $compositionPanier->setIdProduitRayon($this);
        }

        return $this;
    }

    public function removeCompositionPanier(CompositionPanier $compositionPanier): self
    {
        if ($this->compositionPaniers->removeElement($compositionPanier)) {
            // set the owning side to null (unless already changed)
            if ($compositionPanier->getIdProduitRayon() === $this) {
                $compositionPanier->setIdProduitRayon(null);
            }
        }

        return $this;
    }


}
