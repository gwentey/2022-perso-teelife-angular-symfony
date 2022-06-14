<?php

namespace App\Entity;

use App\Repository\AddictionsPersonnageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: AddictionsPersonnageRepository::class)]
class AddictionsPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'addictionsPersonnages')]
    private $id_personnage;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'addictionsPersonnages')]
    #[Groups(['get:info_personnage_full'])]
    private $id_produit;

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

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produit $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }
}
