<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
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
    private $lieu;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EvaluationElements", mappedBy="entreprise")
     */
    private $evaluationElements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="entreprises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="evaluateEntreprise")
     */
    private $evaluateures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="expertEntreprise")
     */
    private $experts;

    /**
     * @ORM\OneToMany(targetEntity=EAF::class, mappedBy="entreprise", orphanRemoval=true)
     */
    private $eAFs;

    /**
     * @ORM\Column(type="array")
     */
    private $etapes = [];

    public function __construct()
    {
        $this->evaluationElements = new ArrayCollection();
        $this->evaluateures = new ArrayCollection();
        $this->experts = new ArrayCollection();
        $this->eAFs = new ArrayCollection();
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|EvaluationElements[]
     */
    public function getEvaluationElements(): Collection
    {
        return $this->evaluationElements;
    }
    /**
     * @return Collection|EvaluationElements[]
     */
    public function getEvaluationElementsNull(): Collection
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('entreprise', $this))
            ->andWhere(Criteria::expr()->eq('parent', null));

        return $this->evaluationElements->matching($criteria);
    }
    /**
     * @return Collection|EvaluationElements[]
     */
    public function getEvaluationElementsNullByUser(User $user): Collection
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('entreprise', $this))
            ->andWhere(Criteria::expr()->eq('parent', null))
            ->andWhere(Criteria::expr()->eq('createur', $user));

        return $this->evaluationElements->matching($criteria);
    }

    public function addEvaluationElement(EvaluationElements $evaluationElement): self
    {
        if (!$this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements[] = $evaluationElement;
            $evaluationElement->setEntreprise($this);
        }

        return $this;
    }

    public function removeEvaluationElement(EvaluationElements $evaluationElement): self
    {
        if ($this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements->removeElement($evaluationElement);
            // set the owning side to null (unless already changed)
            if ($evaluationElement->getEntreprise() === $this) {
                $evaluationElement->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEvaluateures(): Collection
    {
        return $this->evaluateures;
    }

    public function addEvaluateure(User $evaluateure): self
    {
        if (!$this->evaluateures->contains($evaluateure)) {
            $this->evaluateures[] = $evaluateure;
            $evaluateure->setEvaluateEntreprise($this);
        }

        return $this;
    }

    public function removeEvaluateure(User $evaluateure): self
    {
        if ($this->evaluateures->contains($evaluateure)) {
            $this->evaluateures->removeElement($evaluateure);
            // set the owning side to null (unless already changed)
            if ($evaluateure->getEvaluateEntreprise() === $this) {
                $evaluateure->setEvaluateEntreprise(null);
            }
        }

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
            $expert->setExpertEntreprise($this);
        }

        return $this;
    }

    public function removeExpert(User $expert): self
    {
        if ($this->experts->contains($expert)) {
            $this->experts->removeElement($expert);
            // set the owning side to null (unless already changed)
            if ($expert->getExpertEntreprise() === $this) {
                $expert->setExpertEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EAF[]
     */
    public function getEAFs(): Collection
    {
        return $this->eAFs;
    }

    public function addEAF(EAF $eAF): self
    {
        if (!$this->eAFs->contains($eAF)) {
            $this->eAFs[] = $eAF;
            $eAF->setEntreprise($this);
        }

        return $this;
    }

    public function removeEAF(EAF $eAF): self
    {
        if ($this->eAFs->contains($eAF)) {
            $this->eAFs->removeElement($eAF);
            // set the owning side to null (unless already changed)
            if ($eAF->getEntreprise() === $this) {
                $eAF->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getEtapes(): ?array
    {
        return $this->etapes;
    }

    public function setEtapes(array $etapes): self
    {
        $this->etapes = $etapes;

        return $this;
    }
}
