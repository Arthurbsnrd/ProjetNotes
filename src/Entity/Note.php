<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateAjout = null;

    #[ORM\Column(type: "float")]
    #[Assert\NotBlank]
    private ?float $Note = null;

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: "notes")]
    private $matiere;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank]
    private $coefMatiere;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;
        return $this;
    }

    public function getNote(): ?float
    {
        return $this->Note;
    }

    public function setNote(float $Note): self
    {
        $this->Note = $Note;
        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;
        return $this;
    }

    public function getCoefMatiere(): ?int
    {
        return $this->coefMatiere;
    }

    public function setCoefMatiere(int $coefMatiere): self
    {
        $this->coefMatiere = $coefMatiere;
        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->getNote() * $this->getCoefMatiere();
    }

    

}