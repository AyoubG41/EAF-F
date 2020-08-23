<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MappingRepository")
 */
class Mapping
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mappings")
     */
    private $expert;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EvaluationElements", inversedBy="mappings")
     */
    private $EvaluationElement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpert(): ?User
    {
        return $this->expert;
    }

    public function setExpert(?User $expert): self
    {
        $this->expert = $expert;

        return $this;
    }


    public function getEvaluationElement(): ?EvaluationElements
    {
        return $this->EvaluationElement;
    }

    public function setEvaluationElement(?EvaluationElements $EvaluationElement): self
    {
        $this->EvaluationElement = $EvaluationElement;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
