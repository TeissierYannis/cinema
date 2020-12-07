<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
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
     * @ORM\Column(type="string", length=255)
     */
    private $acheteur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_reserver;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="Tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity=Paiement::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $paiements;

    /**
     * @ORM\ManyToOne(targetEntity=Sceance::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sceance;

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

    public function getAcheteur(): ?string
    {
        return $this->acheteur;
    }

    public function setAcheteur(string $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    public function getIsReserver(): ?bool
    {
        return $this->is_reserver;
    }

    public function setIsReserver(bool $is_reserver): self
    {
        $this->is_reserver = $is_reserver;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getPaiements(): ?Paiement
    {
        return $this->paiements;
    }

    public function setPaiements(?Paiement $paiements): self
    {
        $this->paiements = $paiements;

        return $this;
    }

    public function getSceance(): ?Sceance
    {
        return $this->sceance;
    }

    public function setSceance(?Sceance $sceance): self
    {
        $this->sceance = $sceance;

        return $this;
    }
}
