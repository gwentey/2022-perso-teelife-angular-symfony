<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:info_magasin'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_personnage_full', 'get:info_magasin'])]
    private $nom;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_createur;

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_ville;

    #[ORM\OneToMany(mappedBy: 'id_entreprise', targetEntity: Banque::class, cascade: ['persist', 'remove'])]
    private $banques;

    #[ORM\OneToMany(mappedBy: 'id_entreprise', targetEntity: Magasin::class, cascade: ['persist', 'remove'])]
    private $magasins;

    public function __construct()
    {
        $this->banques = new ArrayCollection();
        $this->magasins = new ArrayCollection();
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

    public function getIdCreateur(): ?Personnage
    {
        return $this->id_createur;
    }

    public function setIdCreateur(?Personnage $id_createur): self
    {
        $this->id_createur = $id_createur;

        return $this;
    }

    public function getIdVille(): ?Ville
    {
        return $this->id_ville;
    }

    public function setIdVille(?Ville $id_ville): self
    {
        $this->id_ville = $id_ville;

        return $this;
    }

    /**
     * @return Collection<int, Banque>
     */
    public function getBanques(): Collection
    {
        return $this->banques;
    }

    public function addBanque(Banque $banque): self
    {
        if (!$this->banques->contains($banque)) {
            $this->banques[] = $banque;
            $banque->setIdEntreprise($this);
        }

        return $this;
    }

    public function removeBanque(Banque $banque): self
    {
        if ($this->banques->removeElement($banque)) {
            // set the owning side to null (unless already changed)
            if ($banque->getIdEntreprise() === $this) {
                $banque->setIdEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Magasin>
     */
    public function getMagasins(): Collection
    {
        return $this->magasins;
    }

    public function addMagasin(Magasin $magasin): self
    {
        if (!$this->magasins->contains($magasin)) {
            $this->magasins[] = $magasin;
            $magasin->setIdEntreprise($this);
        }

        return $this;
    }

    public function removeMagasin(Magasin $magasin): self
    {
        if ($this->magasins->removeElement($magasin)) {
            // set the owning side to null (unless already changed)
            if ($magasin->getIdEntreprise() === $this) {
                $magasin->setIdEntreprise(null);
            }
        }

        return $this;
    }
}
