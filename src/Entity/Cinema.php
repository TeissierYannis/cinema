<?php

namespace App\Entity;

use App\Repository\CinemaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CinemaRepository::class)
 */
class Cinema
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
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_salle;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Villes;

    /**
     * @ORM\OneToMany(targetEntity=Salle::class, mappedBy="cinema")
     */
    private $Salles;

    public function __construct()
    {
        $this->Salles = new ArrayCollection();
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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getNbrSalle(): ?int
    {
        return $this->nbr_salle;
    }

    public function setNbrSalle(int $nbr_salle): self
    {
        $this->nbr_salle = $nbr_salle;

        return $this;
    }

    public function getVilles(): ?Ville
    {
        return $this->Villes;
    }

    public function setVilles(?Ville $Villes): self
    {
        $this->Villes = $Villes;

        return $this;
    }

    /**
     * @return Collection|Salle[]
     */
    public function getSalles(): Collection
    {
        return $this->Salles;
    }

    public function addSalle(Salle $salle): self
    {
        if (!$this->Salles->contains($salle)) {
            $this->Salles[] = $salle;
            $salle->setCinema($this);
        }

        return $this;
    }

    public function removeSalle(Salle $salle): self
    {
        if ($this->Salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getCinema() === $this) {
                $salle->setCinema(null);
            }
        }

        return $this;
    }
}
