<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *  fields={"title"},
 *  message="Un autre Document déjà avec ve titre est dejà publié."
 * )
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
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $doi;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $dateProduction;

    

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
     * @Assert\File()
     */
    private $fichier;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDocument::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $typeDocument;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $domaine;

    

    /**
     * @ORM\ManyToOne(targetEntity=Langue::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $langue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublication;

    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $participants;

    

    /**
     * @ORM\ManyToOne(targetEntity=Licence::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $licence;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Veuillez renseignez ce champ")
     */
    private $keywords;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;



    

    public function __construct()
    {
        
        $this->datePublication = new \DateTime();
        $this->motClefs = new ArrayCollection();
        $this->keywords = new ArrayCollection();
        
    }

    /**
     * @ORM\PreUpdate
     */

    public function UpdateAt(){
        $this->setDatePublication(new \DateTime());
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

    

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTimeInterface $dateProduction): self
    {
        $this->dateProduction = $dateProduction;

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

    

    

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    

    public function getParticipants(): ?string
    {
        return $this->participants;
    }

    public function setParticipants(?string $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

   

    public function getLicence(): ?Licence
    {
        return $this->licence;
    }

    public function setLicence(?Licence $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDoi(): ?string
    {
        return $this->doi;
    }

    public function setDoi(?string $doi): self
    {
        $this->doi = $doi;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    

    
    
    

    
}
