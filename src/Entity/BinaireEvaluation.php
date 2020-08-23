<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BinaireEvaluationRepository")
 */
class BinaireEvaluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EAF", inversedBy="binaireEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $firstElement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EAF", inversedBy="binaireEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secondElement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstValue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondValue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="binaireEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstElement(): ?EAF
    {
        return $this->firstElement;
    }

    public function setFirstElement(?EAF $firstElement): self
    {
        $this->firstElement = $firstElement;

        return $this;
    }

    public function getSecondElement(): ?EAF
    {
        return $this->secondElement;
    }

    public function setSecondElement(?EAF $secondElement): self
    {
        $this->secondElement = $secondElement;

        return $this;
    }

    public function getFirstValue(): ?string
    {
        return $this->firstValue;
    }

    public function setFirstValue(?string $firstValue): self
    {
        $this->firstValue = $firstValue;

        return $this;
    }

    public function getSecondValue(): ?string
    {
        return $this->secondValue;
    }

    public function setSecondValue(?string $secondValue): self
    {
        $this->secondValue = $secondValue;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): self
    {
        $this->createur = $createur;

        return $this;
    }
}
