<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreferencesRepository")
 */
class Preferences
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EvaluationElements", inversedBy="preferences")
     */
    private $firstElement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EvaluationElements", inversedBy="preferences")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="preferences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evaluateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstElement(): ?EvaluationElements
    {
        return $this->firstElement;
    }

    public function setFirstElement(?EvaluationElements $firstElement): self
    {
        $this->firstElement = $firstElement;

        return $this;
    }

    public function getSecondElement(): ?EvaluationElements
    {
        return $this->secondElement;
    }

    public function setSecondElement(?EvaluationElements $secondElement): self
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

    public function getEvaluateur(): ?User
    {
        return $this->evaluateur;
    }

    public function setEvaluateur(?User $evaluateur): self
    {
        $this->evaluateur = $evaluateur;

        return $this;
    }


}
