<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvaluationElementsRepository")
 */
class EvaluationElements
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
     * @ORM\ManyToOne(targetEntity="App\Entity\EvaluationElements", inversedBy="evaluationElements")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EvaluationElements", mappedBy="parent")
     */
    private $evaluationElements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Preferences", mappedBy="firstElement")
     */
    private $preferences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mapping", mappedBy="EvaluationElement")
     */
    private $mappings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="evaluationElements")
     */
    private $entreprise;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="evaluationElements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $teamValidate = [];

    /**
     * @ORM\OneToMany(targetEntity=EAF::class, mappedBy="evaluationElement", orphanRemoval=true)
     */
    private $eAFs;



    public function __construct()
    {
        $this->evaluationElements = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->mappings = new ArrayCollection();
        $this->EAFElements = new ArrayCollection();
        $this->EAF = new ArrayCollection();
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEvaluationElements(): Collection
    {
        return $this->evaluationElements;
    }


    public function addEvaluationElement(self $evaluationElement): self
    {
        if (!$this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements[] = $evaluationElement;
            $evaluationElement->setParent($this);
        }

        return $this;
    }

    public function removeEvaluationElement(self $evaluationElement): self
    {
        if ($this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements->removeElement($evaluationElement);
            // set the owning side to null (unless already changed)
            if ($evaluationElement->getParent() === $this) {
                $evaluationElement->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Preferences[]
     */
    public function getPreferences(): Collection
    {
        return $this->preferences;
    }

    public function addPreference(Preferences $preference): self
    {
        if (!$this->preferences->contains($preference)) {
            $this->preferences[] = $preference;
            $preference->setFirstElement($this);
        }

        return $this;
    }

    public function removePreference(Preferences $preference): self
    {
        if ($this->preferences->contains($preference)) {
            $this->preferences->removeElement($preference);
            // set the owning side to null (unless already changed)
            if ($preference->getFirstElement() === $this) {
                $preference->setFirstElement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mapping[]
     */
    public function getMappings(): Collection
    {
        return $this->mappings;
    }

    public function addMapping(Mapping $mapping): self
    {
        if (!$this->mappings->contains($mapping)) {
            $this->mappings[] = $mapping;
            $mapping->setEvaluationElement($this);
        }

        return $this;
    }

    public function removeMapping(Mapping $mapping): self
    {
        if ($this->mappings->contains($mapping)) {
            $this->mappings->removeElement($mapping);
            // set the owning side to null (unless already changed)
            if ($mapping->getEvaluationElement() === $this) {
                $mapping->setEvaluationElement(null);
            }
        }

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
    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    public function getValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

    public function getTeamValidate(): ?array
    {
        return $this->teamValidate;
    }

    public function setTeamValidate(?array $teamValidate): self
    {
        $this->teamValidate = $teamValidate;

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
            $eAF->setEvaluationElement($this);
        }

        return $this;
    }

    public function removeEAF(EAF $eAF): self
    {
        if ($this->eAFs->contains($eAF)) {
            $this->eAFs->removeElement($eAF);
            // set the owning side to null (unless already changed)
            if ($eAF->getEvaluationElement() === $this) {
                $eAF->setEvaluationElement(null);
            }
        }

        return $this;
    }

    }
