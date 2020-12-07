<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
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
    private $emplacement;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="Places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salle;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="place")
     */
    private $Tickets;

    public function __construct()
    {
        $this->Tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacement(): ?int
    {
        return $this->emplacement;
    }

    public function setEmplacement(int $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->Tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->Tickets->contains($ticket)) {
            $this->Tickets[] = $ticket;
            $ticket->setPlace($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->Tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getPlace() === $this) {
                $ticket->setPlace(null);
            }
        }

        return $this;
    }
}
