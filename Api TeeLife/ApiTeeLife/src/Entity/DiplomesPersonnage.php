<?php

namespace App\Entity;

use App\Repository\DiplomesPersonnageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: DiplomesPersonnageRepository::class)]
class DiplomesPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'diplomesPersonnages')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_personnage;

    #[ORM\ManyToOne(targetEntity: Diplome::class, inversedBy: 'diplomesPersonnages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:info_personnage_full'])]
    private $id_diplome;

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

    public function getIdDiplome(): ?Diplome
    {
        return $this->id_diplome;
    }

    public function setIdDiplome(?Diplome $id_diplome): self
    {
        $this->id_diplome = $id_diplome;

        return $this;
    }
}
