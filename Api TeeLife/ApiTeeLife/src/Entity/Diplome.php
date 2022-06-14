<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: DiplomeRepository::class)]
class Diplome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_personnage_full'])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'id_diplome', targetEntity: DiplomesPersonnage::class)]
    private $diplomesPersonnages;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    public function __construct()
    {
        $this->diplomesPersonnages = new ArrayCollection();
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
     * @return Collection<int, DiplomesPersonnage>
     */
    public function getDiplomesPersonnages(): Collection
    {
        return $this->diplomesPersonnages;
    }

    public function addDiplomesPersonnage(DiplomesPersonnage $diplomesPersonnage): self
    {
        if (!$this->diplomesPersonnages->contains($diplomesPersonnage)) {
            $this->diplomesPersonnages[] = $diplomesPersonnage;
            $diplomesPersonnage->setIdDiplome($this);
        }

        return $this;
    }

    public function removeDiplomesPersonnage(DiplomesPersonnage $diplomesPersonnage): self
    {
        if ($this->diplomesPersonnages->removeElement($diplomesPersonnage)) {
            // set the owning side to null (unless already changed)
            if ($diplomesPersonnage->getIdDiplome() === $this) {
                $diplomesPersonnage->setIdDiplome(null);
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
}
