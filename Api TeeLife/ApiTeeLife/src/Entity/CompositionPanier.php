<?php

namespace App\Entity;

use App\Repository\CompositionPanierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CompositionPanierRepository::class)]
class CompositionPanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:panier'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Panier::class, inversedBy: 'compositionPaniers')]
    private $id_panier;

    #[ORM\ManyToOne(targetEntity: ProduitRayon::class, inversedBy: 'compositionPaniers')]
    #[Groups(['get:panier'])]
    private $id_produitRayon;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:panier'])]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPanier(): ?Panier
    {
        return $this->id_panier;
    }

    public function setIdPanier(?Panier $id_panier): self
    {
        $this->id_panier = $id_panier;

        return $this;
    }

    public function getIdProduitRayon(): ?ProduitRayon
    {
        return $this->id_produitRayon;
    }

    public function setIdProduitRayon(?ProduitRayon $id_produitRayon): self
    {
        $this->id_produitRayon = $id_produitRayon;

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
}
