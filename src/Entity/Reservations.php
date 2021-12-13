<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationsRepository", repositoryClass=ReservationsRepository::class)
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Books::class, inversedBy="reservations", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $bname;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="uemail", referencedColumnName="email")
     */
    private $uemail;

    /**
     * @ORM\Column(type="date")
     */
    private $taken;

    public function __construct()
    {
        $this->uemail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBname(): ?Books
    {
        return $this->bname;
    }

    public function setBname(Books $bname): self
    {
        $this->bname = $bname;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUemail(): Collection
    {
        return $this->uemail;
    }

    public function addUemail(User $uemail): self
    {
        if (!$this->uemail->contains($uemail)) {
            $this->uemail[] = $uemail;
        }

        return $this;
    }

    public function removeUemail(User $uemail): self
    {
        $this->uemail->removeElement($uemail);

        return $this;
    }

    public function getTaken(): ?\DateTimeInterface
    {
        return $this->taken;
    }

    public function setTaken(\DateTimeInterface $taken): self
    {
        $this->taken = $taken;

        return $this;
    }
}
