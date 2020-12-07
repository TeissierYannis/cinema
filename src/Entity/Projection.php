<?php

namespace App\Entity;

use App\Repository\ProjectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectionRepository::class)
 */
class Projection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="projections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salles;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="projections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity=Sceance::class, mappedBy="projection")
     */
    private $sceances;

    public function __construct()
    {
        $this->sceances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSalles(): ?Salle
    {
        return $this->salles;
    }

    public function setSalles(?Salle $salles): self
    {
        $this->salles = $salles;

        return $this;
    }

    public function getFilms(): ?Film
    {
        return $this->films;
    }

    public function setFilms(?Film $films): self
    {
        $this->films = $films;

        return $this;
    }

    /**
     * @return Collection|Sceance[]
     */
    public function getSceances(): Collection
    {
        return $this->sceances;
    }

    public function addSceance(Sceance $sceance): self
    {
        if (!$this->sceances->contains($sceance)) {
            $this->sceances[] = $sceance;
            $sceance->setProjection($this);
        }

        return $this;
    }

    public function removeSceance(Sceance $sceance): self
    {
        if ($this->sceances->removeElement($sceance)) {
            // set the owning side to null (unless already changed)
            if ($sceance->getProjection() === $this) {
                $sceance->setProjection(null);
            }
        }

        return $this;
    }
}
