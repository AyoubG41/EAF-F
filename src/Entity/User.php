<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experience;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mapping", mappedBy="expert")
     */
    private $mappings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EAF", mappedBy="experts")
     */
    private $eAFs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entreprise", mappedBy="manager", orphanRemoval=true)
     */
    private $entreprises;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="evaluateures")
     */
    private $evaluateEntreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="experts")
     */
    private $expertEntreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EvaluationElements", mappedBy="createur", orphanRemoval=true)
     */
    private $evaluationElements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Preferences", mappedBy="evaluateur", orphanRemoval=true)
     */
    private $preferences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BinaireEvaluation", mappedBy="createur", orphanRemoval=true)
     */
    private $binaireEvaluations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EAF", mappedBy="createur", orphanRemoval=true)
     */
    private $created_eaf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $generated_by;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain;


    public function __construct()
    {
        parent::__construct();
        $this->eAFs = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
        $this->evaluationElements = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->binaireEvaluations = new ArrayCollection();
        $this->created_eaf = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

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
            $mapping->setExpert($this);
        }

        return $this;
    }

    public function removeMapping(Mapping $mapping): self
    {
        if ($this->mappings->contains($mapping)) {
            $this->mappings->removeElement($mapping);
            // set the owning side to null (unless already changed)
            if ($mapping->getExpert() === $this) {
                $mapping->setExpert(null);
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
            $eAF->addExpert($this);
        }

        return $this;
    }

    public function removeEAF(EAF $eAF): self
    {
        if ($this->eAFs->contains($eAF)) {
            $this->eAFs->removeElement($eAF);
            $eAF->removeExpert($this);
        }

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setManager($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->contains($entreprise)) {
            $this->entreprises->removeElement($entreprise);
            // set the owning side to null (unless already changed)
            if ($entreprise->getManager() === $this) {
                $entreprise->setManager(null);
            }
        }

        return $this;
    }

    public function getEvaluateEntreprise(): ?Entreprise
    {
        return $this->evaluateEntreprise;
    }

    public function setEvaluateEntreprise(?Entreprise $evaluateEntreprise): self
    {
        $this->evaluateEntreprise = $evaluateEntreprise;

        return $this;
    }

    public function getExpertEntreprise(): ?Entreprise
    {
        return $this->expertEntreprise;
    }

    public function setExpertEntreprise(?Entreprise $expertEntreprise): self
    {
        $this->expertEntreprise = $expertEntreprise;

        return $this;
    }

    /**
     * @return Collection|EvaluationElements[]
     */
    public function getEvaluationElements(): Collection
    {
        return $this->evaluationElements;
    }

    public function addEvaluationElement(EvaluationElements $evaluationElement): self
    {
        if (!$this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements[] = $evaluationElement;
            $evaluationElement->setCreateur($this);
        }

        return $this;
    }

    public function removeEvaluationElement(EvaluationElements $evaluationElement): self
    {
        if ($this->evaluationElements->contains($evaluationElement)) {
            $this->evaluationElements->removeElement($evaluationElement);
            // set the owning side to null (unless already changed)
            if ($evaluationElement->getCreateur() === $this) {
                $evaluationElement->setCreateur(null);
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
            $preference->setEvaluateur($this);
        }

        return $this;
    }

    public function removePreference(Preferences $preference): self
    {
        if ($this->preferences->contains($preference)) {
            $this->preferences->removeElement($preference);
            // set the owning side to null (unless already changed)
            if ($preference->getEvaluateur() === $this) {
                $preference->setEvaluateur(null);
            }
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
            $binaireEvaluation->setCreateur($this);
        }

        return $this;
    }

    public function removeBinaireEvaluation(BinaireEvaluation $binaireEvaluation): self
    {
        if ($this->binaireEvaluations->contains($binaireEvaluation)) {
            $this->binaireEvaluations->removeElement($binaireEvaluation);
            // set the owning side to null (unless already changed)
            if ($binaireEvaluation->getCreateur() === $this) {
                $binaireEvaluation->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EAF[]
     */
    public function getCreatedEaf(): Collection
    {
        return $this->created_eaf;
    }

    public function addCreatedEaf(EAF $createdEaf): self
    {
        if (!$this->created_eaf->contains($createdEaf)) {
            $this->created_eaf[] = $createdEaf;
            $createdEaf->setCreateur($this);
        }

        return $this;
    }

    public function removeCreatedEaf(EAF $createdEaf): self
    {
        if ($this->created_eaf->contains($createdEaf)) {
            $this->created_eaf->removeElement($createdEaf);
            // set the owning side to null (unless already changed)
            if ($createdEaf->getCreateur() === $this) {
                $createdEaf->setCreateur(null);
            }
        }

        return $this;
    }

    public function getGeneratedBy(): ?string
    {
        return $this->generated_by;
    }

    public function setGeneratedBy(?string $generated_by): self
    {
        $this->generated_by = $generated_by;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }


}
