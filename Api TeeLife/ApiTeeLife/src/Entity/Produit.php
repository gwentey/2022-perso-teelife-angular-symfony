<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:rayon_by_magasin', 'get:panier', 'get:composition_seulement'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_personnage_full', 'get:rayon_by_magasin', 'get:panier', 'get:composition_seulement'])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'id_produit', targetEntity: ProduitRayon::class)]
    private $produitRayons;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:rayon_by_magasin'])]
    private $image;

    #[ORM\OneToMany(mappedBy: 'id_produit', targetEntity: AddictionsPersonnage::class)]
    private $addictionsPersonnages;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['get:rayon_by_magasin'])]
    private $addictif;

    public function __construct()
    {
        $this->produitRayons = new ArrayCollection();
        $this->addictionsPersonnages = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection<int, ProduitRayon>
     */
    public function getProduitRayons(): Collection
    {
        return $this->produitRayons;
    }

    public function addProduitRayon(ProduitRayon $produitRayon): self
    {
        if (!$this->produitRayons->contains($produitRayon)) {
            $this->produitRayons[] = $produitRayon;
            $produitRayon->setIdProduit($this);
        }

        return $this;
    }

    public function removeProduitRayon(ProduitRayon $produitRayon): self
    {
        if ($this->produitRayons->removeElement($produitRayon)) {
            // set the owning side to null (unless already changed)
            if ($produitRayon->getIdProduit() === $this) {
                $produitRayon->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, AddictionsPersonnage>
     */
    public function getAddictionsPersonnages(): Collection
    {
        return $this->addictionsPersonnages;
    }

    public function addAddictionsPersonnage(AddictionsPersonnage $addictionsPersonnage): self
    {
        if (!$this->addictionsPersonnages->contains($addictionsPersonnage)) {
            $this->addictionsPersonnages[] = $addictionsPersonnage;
            $addictionsPersonnage->setIdProduit($this);
        }

        return $this;
    }

    public function removeAddictionsPersonnage(AddictionsPersonnage $addictionsPersonnage): self
    {
        if ($this->addictionsPersonnages->removeElement($addictionsPersonnage)) {
            // set the owning side to null (unless already changed)
            if ($addictionsPersonnage->getIdProduit() === $this) {
                $addictionsPersonnage->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getAddictif(): ?bool
    {
        return $this->addictif;
    }

    public function setAddictif(bool $addictif): self
    {
        $this->addictif = $addictif;

        return $this;
    }
}
