<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleRepository::class)
 */
class Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Cinema::class, inversedBy="Salles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cinema;

    /**
     * @ORM\OneToMany(targetEntity=Place::class, mappedBy="salle")
     */
    private $Places;

    /**
     * @ORM\OneToMany(targetEntity=Projection::class, mappedBy="salles")
     */
    private $projections;

    public function __construct()
    {
        $this->Places = new ArrayCollection();
        $this->projections = new ArrayCollection();
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

    public function getCinema(): ?Cinema
    {
        return $this->cinema;
    }

    public function setCinema(?Cinema $cinema): self
    {
        $this->cinema = $cinema;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->Places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->Places->contains($place)) {
            $this->Places[] = $place;
            $place->setSalle($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->Places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getSalle() === $this) {
                $place->setSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projection[]
     */
    public function getProjections(): Collection
    {
        return $this->projections;
    }

    public function addProjection(Projection $projection): self
    {
        if (!$this->projections->contains($projection)) {
            $this->projections[] = $projection;
            $projection->setSalles($this);
        }

        return $this;
    }

    public function removeProjection(Projection $projection): self
    {
        if ($this->projections->removeElement($projection)) {
            // set the owning side to null (unless already changed)
            if ($projection->getSalles() === $this) {
                $projection->setSalles(null);
            }
        }

        return $this;
    }
}
