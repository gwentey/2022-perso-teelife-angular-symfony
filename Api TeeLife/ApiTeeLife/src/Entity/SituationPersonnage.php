<?php

namespace App\Entity;

use App\Repository\SituationPersonnageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SituationPersonnageRepository::class)]
class SituationPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'situationPersonnage', targetEntity: Personnage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $id_personnage;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['get:info_personnage_full'])]
    private $argent_liquide;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]

    private $goldentee;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['get:info_personnage_full'])]
    private $argent_sale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersonnage(): ?Personnage
    {
        return $this->id_personnage;
    }

    public function setIdPersonnage(Personnage $id_personnage): self
    {
        $this->id_personnage = $id_personnage;

        return $this;
    }

    public function getArgentLiquide(): ?string
    {
        return $this->argent_liquide;
    }

    public function setArgentLiquide(string $argent_liquide): self
    {
        $this->argent_liquide = $argent_liquide;

        return $this;
    }

    public function getGoldentee(): ?string
    {
        return $this->goldentee;
    }

    public function setGoldentee(string $goldentee): self
    {
        $this->goldentee = $goldentee;

        return $this;
    }

    public function getArgentSale(): ?string
    {
        return $this->argent_sale;
    }

    public function setArgentSale(string $argent_sale): self
    {
        $this->argent_sale = $argent_sale;

        return $this;
    }
}
