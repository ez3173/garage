<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La marque ne peut pas être vide.")]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le modèle ne peut pas être vide.")]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'image principale ne peut pas être vide.")]
    #[Assert\Url(message: "Le chemin de l'image principale doit être une URL valide.")]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThanOrEqual(0, message: "Le kilométrage doit être un nombre positif.")]
    #[Assert\Type(type: 'integer', message: "Le kilométrage doit être un entier.")]
    private ?int $km = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(0, message: "Le prix doit être un nombre positif.")]
    #[Assert\Type(type: 'float', message: "Le prix doit être un nombre valide.")]
    private ?float $prix = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(0, message: "Le nombre de propriétaires doit être positif.")]
    private ?int $nombre_proprietaires = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La cylindrée ne peut pas être vide.")]
    private ?string $cylindree = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La puissance ne peut pas être vide.")]
    private ?string $puissance = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le carburant ne peut pas être vide.")]
    private ?string $carburant = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "L'année de mise en circulation ne peut pas être vide.")]
    #[Assert\Range(
        min: 1900,
        max: 2100,
        notInRangeMessage: "L'année de mise en circulation doit être comprise entre {{ min }} et {{ max }}."
    )]
    private ?int $annee_mise_en_circulation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La transmission ne peut pas être vide.")]
    private ?string $transmission = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "La description ne peut pas être vide.")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $options = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'voiture')]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(?int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNombreProprietaires(): ?int
    {
        return $this->nombre_proprietaires;
    }

    public function setNombreProprietaires(int $nombre_proprietaire): static
    {
        $this->nombre_proprietaires = $nombre_proprietaire;

        return $this;
    }

    public function getCylindree(): ?string
    {
        return $this->cylindree;
    }

    public function setCylindree(string $cylindree): static
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissance(): ?string
    {
        return $this->puissance;
    }

    public function setPuissance(string $puissance): static
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): static
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getAnneeMiseEnCirculation(): ?int
    {
        return $this->annee_mise_en_circulation;
    }

    public function setAnneeMiseEnCirculation(int $annee_mise_en_circulation): static
    {
        $this->annee_mise_en_circulation = $annee_mise_en_circulation;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVoiture($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVoiture() === $this) {
                $image->setVoiture(null);
            }
        }

        return $this;
    }
}
