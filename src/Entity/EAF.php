<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EAFRepository")
 */
class EAF
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="eAFs")
     */
    private $experts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BinaireEvaluation", mappedBy="firstElement", orphanRemoval=true)
     */
    private $binaireEvaluations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="created_eaf")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="eAFs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=EvaluationElements::class, inversedBy="eAFs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evaluationElement;

    public function __construct()
    {
        $this->eAFElements = new ArrayCollection();
        $this->experts = new ArrayCollection();
        $this->binaireEvaluations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

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

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getExperts(): Collection
    {
        return $this->experts;
    }

    public function addExpert(User $expert): self
    {
        if (!$this->experts->contains($expert)) {
            $this->experts[] = $expert;
        }

        return $this;
    }

    public function removeExpert(User $expert): self
    {
        if ($this->experts->contains($expert)) {
            $this->experts->removeElement($expert);
        }

        return $this;
    }

    /**
     * @return Collection|BinaireEvaluation[]
     */
    public function getBinaireEvaluations(): Collection
    {
        return $this->binaireEvaluations;
    }

    public function addBinaireEvaluation(BinaireEvaluation $binaireEvaluation): self
    {
        if (!$this->binaireEvaluations->contains($binaireEvaluation)) {
            $this->binaireEvaluations[] = $binaireEvaluation;
            $binaireEvaluation->setFirstElement($this);
        }

        return $this;
    }

    public function removeBinaireEvaluation(BinaireEvaluation $binaireEvaluation): self
    {
        if ($this->binaireEvaluations->contains($binaireEvaluation)) {
            $this->binaireEvaluations->removeElement($binaireEvaluation);
            // set the owning side to null (unless already changed)
            if ($binaireEvaluation->getFirstElement() === $this) {
                $binaireEvaluation->setFirstElement(null);
            }
        }

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

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getEvaluationElement(): ?EvaluationElements
    {
        return $this->evaluationElement;
    }

    public function setEvaluationElement(?EvaluationElements $evaluationElement): self
    {
        $this->evaluationElement = $evaluationElement;

        return $this;
    }
}
