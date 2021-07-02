<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $doi;

    /**
     * @ORM\Column(type="date")
     */
    private $dateProduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $licence;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $classification;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $collaboration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlLie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeAnr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refInterne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projetsLies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $financement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteurAjoute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $affiliation;

    /**
     * @ORM\OneToOne(targetEntity=Fichier::class, cascade={"persist", "remove"})
     */
    private $fichier;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDocument::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDocument;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domaine;

    /**
     * @ORM\ManyToMany(targetEntity=MotClef::class, inversedBy="documents")
     */
    private $motClef;

    /**
     * @ORM\ManyToOne(targetEntity=Langue::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $langue;

    public function __construct()
    {
        $this->motClef = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDoi(): ?int
    {
        return $this->doi;
    }

    public function setDoi(?int $doi): self
    {
        $this->doi = $doi;

        return $this;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTimeInterface $dateProduction): self
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    public function getLicence(): ?string
    {
        return $this->licence;
    }

    public function setLicence(string $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getClassification(): ?string
    {
        return $this->classification;
    }

    public function setClassification(?string $classification): self
    {
        $this->classification = $classification;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCollaboration(): ?string
    {
        return $this->collaboration;
    }

    public function setCollaboration(?string $collaboration): self
    {
        $this->collaboration = $collaboration;

        return $this;
    }

    public function getUrlLie(): ?string
    {
        return $this->urlLie;
    }

    public function setUrlLie(?string $urlLie): self
    {
        $this->urlLie = $urlLie;

        return $this;
    }

    public function getCodeAnr(): ?string
    {
        return $this->codeAnr;
    }

    public function setCodeAnr(?string $codeAnr): self
    {
        $this->codeAnr = $codeAnr;

        return $this;
    }

    public function getRefInterne(): ?string
    {
        return $this->refInterne;
    }

    public function setRefInterne(?string $refInterne): self
    {
        $this->refInterne = $refInterne;

        return $this;
    }

    public function getProjetsLies(): ?string
    {
        return $this->projetsLies;
    }

    public function setProjetsLies(?string $projetsLies): self
    {
        $this->projetsLies = $projetsLies;

        return $this;
    }

    public function getFinancement(): ?string
    {
        return $this->financement;
    }

    public function setFinancement(?string $financement): self
    {
        $this->financement = $financement;

        return $this;
    }

    public function getAuteurAjoute(): ?string
    {
        return $this->auteurAjoute;
    }

    public function setAuteurAjoute(?string $auteurAjoute): self
    {
        $this->auteurAjoute = $auteurAjoute;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(?string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getTypeDocument(): ?TypeDocument
    {
        return $this->typeDocument;
    }

    public function setTypeDocument(?TypeDocument $typeDocument): self
    {
        $this->typeDocument = $typeDocument;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * @return Collection|MotClef[]
     */
    public function getMotClef(): Collection
    {
        return $this->motClef;
    }

    public function addMotClef(MotClef $motClef): self
    {
        if (!$this->motClef->contains($motClef)) {
            $this->motClef[] = $motClef;
        }

        return $this;
    }

    public function removeMotClef(MotClef $motClef): self
    {
        $this->motClef->removeElement($motClef);

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    
}
