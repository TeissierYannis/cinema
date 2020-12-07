<?php

namespace App\Entity;

use App\Repository\SceanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SceanceRepository::class)
 */
class Sceance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $debut;

    /**
     * @ORM\ManyToOne(targetEntity=Projection::class, inversedBy="sceances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projection;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="sceance")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?int
    {
        return $this->debut;
    }

    public function setDebut(int $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getProjection(): ?Projection
    {
        return $this->projection;
    }

    public function setProjection(?Projection $projection): self
    {
        $this->projection = $projection;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setSceance($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSceance() === $this) {
                $ticket->setSceance(null);
            }
        }

        return $this;
    }
}
