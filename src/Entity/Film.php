<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
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
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $affiche;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Projection::class, mappedBy="films")
     */
    private $projections;

    public function __construct()
    {
        $this->projections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $projection->setFilms($this);
        }

        return $this;
    }

    public function removeProjection(Projection $projection): self
    {
        if ($this->projections->removeElement($projection)) {
            // set the owning side to null (unless already changed)
            if ($projection->getFilms() === $this) {
                $projection->setFilms(null);
            }
        }

        return $this;
    }
}
