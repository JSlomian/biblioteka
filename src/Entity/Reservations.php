<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;

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
     * @ORM\OneToOne(targetEntity=Books::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bname;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(name="uemail", referencedColumnName="id")
     */
    private $uemail;

    /**
     * @ORM\Column(type="date")
     */
    private $taken;

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

    public function getUemail(): ?User
    {
        return $this->uemail;
    }

    public function setUemail(User $uemail): self
    {
        $this->uemail = $uemail;

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
    public function __toString(): string {
        return $this->uemail;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new UniqueEntity([
            'entityClass' => Reservations::class,
            'fields' => ['bname'],
        ]));
    }
}