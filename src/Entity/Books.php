<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descri;

    /**
     * @ORM\OneToOne(targetEntity=Reservations::class, mappedBy="bname", cascade={"persist", "remove"})
     */
    private $reservations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescri(): ?string
    {
        return $this->descri;
    }

    public function setDescri(?string $descri): self
    {
        $this->descri = $descri;

        return $this;
    }

    public function getReservations(): ?Reservations
    {
        return $this->reservations;
    }

    public function setReservations(Reservations $reservations): self
    {
        // set the owning side of the relation if necessary
        if ($reservations->getBname() !== $this) {
            $reservations->setBname($this);
        }

        $this->reservations = $reservations;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(string $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function __toString(): string
    {
    return $this->name;
    }
}
