<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: MagasinRepository::class)]
class Magasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:info_magasin'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_magasin', 'get:panier'])]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get:info_magasin'])]
    private $presentation_courte;

    #[ORM\ManyToOne(targetEntity: Entreprise::class, inversedBy: 'magasins')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:info_magasin'])]
    private $id_entreprise;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get:info_magasin'])]
    private $image_affichage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get:info_magasin'])]
    private $image_couverture;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get:info_magasin'])]
    private $presentation;

    #[ORM\OneToMany(mappedBy: 'id_magasin', targetEntity: RayonMagasin::class)]
    #[Groups(['get:info_magasin'])]
    private $rayonMagasins;

    #[ORM\OneToMany(mappedBy: 'id_magasin', targetEntity: Panier::class)]
    private $paniers;



    public function __construct()
    {
        $this->rayonMagasins = new ArrayCollection();
        $this->compositionPaniers = new ArrayCollection();
        $this->paniers = new ArrayCollection();
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

    public function getPresentationCourte(): ?string
    {
        return $this->presentation_courte;
    }

    public function setPresentationCourte(string $presentation_courte): self
    {
        $this->presentation_courte = $presentation_courte;

        return $this;
    }

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->id_entreprise;
    }

    public function setIdEntreprise(?Entreprise $id_entreprise): self
    {
        $this->id_entreprise = $id_entreprise;

        return $this;
    }

    public function getImageAffichage(): ?string
    {
        return $this->image_affichage;
    }

    public function setImageAffichage(string $image_affichage): self
    {
        $this->image_affichage = $image_affichage;

        return $this;
    }

    public function getImageCouverture(): ?string
    {
        return $this->image_couverture;
    }

    public function setImageCouverture(?string $image_couverture): self
    {
        $this->image_couverture = $image_couverture;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * @return Collection<int, RayonMagasin>
     */
    public function getRayonMagasins(): Collection
    {
        return $this->rayonMagasins;
    }

    public function addRayonMagasin(RayonMagasin $rayonMagasin): self
    {
        if (!$this->rayonMagasins->contains($rayonMagasin)) {
            $this->rayonMagasins[] = $rayonMagasin;
            $rayonMagasin->setIdMagasin($this);
        }

        return $this;
    }

    public function removeRayonMagasin(RayonMagasin $rayonMagasin): self
    {
        if ($this->rayonMagasins->removeElement($rayonMagasin)) {
            // set the owning side to null (unless already changed)
            if ($rayonMagasin->getIdMagasin() === $this) {
                $rayonMagasin->setIdMagasin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setIdMagasin($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getIdMagasin() === $this) {
                $panier->setIdMagasin(null);
            }
        }

        return $this;
    }


}
