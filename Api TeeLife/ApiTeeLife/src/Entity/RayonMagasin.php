<?php

namespace App\Entity;

use App\Repository\RayonMagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: RayonMagasinRepository::class)]
class RayonMagasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:rayon_by_magasin', 'get:panier'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:rayon_by_magasin'])]
    private $nom;

    #[ORM\ManyToOne(targetEntity: Magasin::class, inversedBy: 'rayonMagasins')]
    private $id_magasin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get:rayon_by_magasin'])]
    private $image;

    #[ORM\OneToMany(mappedBy: 'id_rayon', targetEntity: ProduitRayon::class)]
    #[Groups(['get:rayon_by_magasin'])]
    private $produitRayons;

    public function __construct()
    {
        $this->produitRayons = new ArrayCollection();
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

    public function getIdMagasin(): ?Magasin
    {
        return $this->id_magasin;
    }

    public function setIdMagasin(?Magasin $id_magasin): self
    {
        $this->id_magasin = $id_magasin;

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
            $produitRayon->setIdRayon($this);
        }

        return $this;
    }

    public function removeProduitRayon(ProduitRayon $produitRayon): self
    {
        if ($this->produitRayons->removeElement($produitRayon)) {
            // set the owning side to null (unless already changed)
            if ($produitRayon->getIdRayon() === $this) {
                $produitRayon->setIdRayon(null);
            }
        }

        return $this;
    }
}
