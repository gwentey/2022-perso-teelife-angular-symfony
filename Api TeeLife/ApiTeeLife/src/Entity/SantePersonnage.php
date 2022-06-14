<?php

namespace App\Entity;

use App\Repository\SantePersonnageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SantePersonnageRepository::class)]
class SantePersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'santePersonnage', targetEntity: Personnage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $id_personnage;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $vitalite;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $faim;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $soif;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $sante;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $physique;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $bonheur;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $gentilesse;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $proprete;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $maladie;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $urine;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $selles;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $dechets;

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

    public function getVitalite(): ?string
    {
        return $this->vitalite;
    }

    public function setVitalite(string $vitalite): self
    {
        $this->vitalite = $vitalite;

        return $this;
    }

    public function getFaim(): ?string
    {
        return $this->faim;
    }

    public function setFaim(string $faim): self
    {
        $this->faim = $faim;

        return $this;
    }

    public function getSoif(): ?string
    {
        return $this->soif;
    }

    public function setSoif(string $soif): self
    {
        $this->soif = $soif;

        return $this;
    }

    public function getSante(): ?string
    {
        return $this->sante;
    }

    public function setSante(string $sante): self
    {
        $this->sante = $sante;

        return $this;
    }

    public function getPhysique(): ?string
    {
        return $this->physique;
    }

    public function setPhysique(string $physique): self
    {
        $this->physique = $physique;

        return $this;
    }

    public function getBonheur(): ?string
    {
        return $this->bonheur;
    }

    public function setBonheur(string $bonheur): self
    {
        $this->bonheur = $bonheur;

        return $this;
    }

    public function getGentilesse(): ?string
    {
        return $this->gentilesse;
    }

    public function setGentilesse(string $gentilesse): self
    {
        $this->gentilesse = $gentilesse;

        return $this;
    }

    public function getProprete(): ?string
    {
        return $this->proprete;
    }

    public function setProprete(string $proprete): self
    {
        $this->proprete = $proprete;

        return $this;
    }

    public function getMaladie(): ?string
    {
        return $this->maladie;
    }

    public function setMaladie(string $maladie): self
    {
        $this->maladie = $maladie;

        return $this;
    }

    public function getUrine(): ?string
    {
        return $this->urine;
    }

    public function setUrine(string $urine): self
    {
        $this->urine = $urine;

        return $this;
    }

    public function getSelles(): ?string
    {
        return $this->selles;
    }

    public function setSelles(string $selles): self
    {
        $this->selles = $selles;

        return $this;
    }

    public function getDechets(): ?string
    {
        return $this->dechets;
    }

    public function setDechets(string $dechets): self
    {
        $this->dechets = $dechets;

        return $this;
    }
}
