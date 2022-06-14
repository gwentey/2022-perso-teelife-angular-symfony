<?php

namespace App\Entity;

use App\Repository\InteractionsPersonnageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: InteractionsPersonnageRepository::class)]
class InteractionsPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'interactionsPersonnage', targetEntity: Personnage::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $id_personnage;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $bisous;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $calins;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $charmes;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $sourires;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $clins_doeil;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $mains_serrees;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $gifles;

    #[ORM\Column(type: 'bigint')]
    #[Groups(['get:info_personnage_full'])]
    private $corche_pieds;

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

    public function getBisous(): ?string
    {
        return $this->bisous;
    }

    public function setBisous(string $bisous): self
    {
        $this->bisous = $bisous;

        return $this;
    }

    public function getCalins(): ?string
    {
        return $this->calins;
    }

    public function setCalins(string $calins): self
    {
        $this->calins = $calins;

        return $this;
    }

    public function getCharmes(): ?string
    {
        return $this->charmes;
    }

    public function setCharmes(string $charmes): self
    {
        $this->charmes = $charmes;

        return $this;
    }

    public function getSourires(): ?string
    {
        return $this->sourires;
    }

    public function setSourires(string $sourires): self
    {
        $this->sourires = $sourires;

        return $this;
    }

    public function getClinsDoeil(): ?string
    {
        return $this->clins_doeil;
    }

    public function setClinsDoeil(string $clins_doeil): self
    {
        $this->clins_doeil = $clins_doeil;

        return $this;
    }

    public function getMainsSerrees(): ?string
    {
        return $this->mains_serrees;
    }

    public function setMainsSerrees(string $mains_serrees): self
    {
        $this->mains_serrees = $mains_serrees;

        return $this;
    }

    public function getGifles(): ?string
    {
        return $this->gifles;
    }

    public function setGifles(string $gifles): self
    {
        $this->gifles = $gifles;

        return $this;
    }

    public function getCorchePieds(): ?string
    {
        return $this->corche_pieds;
    }

    public function setCorchePieds(string $corche_pieds): self
    {
        $this->corche_pieds = $corche_pieds;

        return $this;
    }
}
