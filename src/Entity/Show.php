<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ShowRepository::class)
 * @ORM\Table(name="`show`")
 * @UniqueEntity("slug")
 */
class Show
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
	

    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster_url;

    /**
     * @ORM\ManyToOne(targetEntity=Locations::class, inversedBy="shows")
	 * @JoinColumn(onDelete="RESTRICT")
     */
    private $location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bookable;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity=Representation::class, mappedBy="the_show", orphanRemoval=true)
     */
   

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPosterUrl(): ?string
    {
        return $this->poster_url;
    }

    public function setPosterUrl(?string $poster_url): self
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getLocation(): ?Locations
    {
        return $this->location;
    }

    public function setLocation(?Locations $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getBookable(): ?bool
    {
        return $this->bookable;
    }

    public function setBookable(bool $bookable): self
    {
        $this->bookable = $bookable;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Representation", mappedBy="the_show", orphanRemoval=true)
     */
    private $representations;

    /**
     * @ORM\ManyToMany(targetEntity=ArtistsTypes::class, inversedBy="shows")
     */
    private $artistTypes;

    public function __construct()
    {
        $this->representations = new ArrayCollection();
        $this->artistTypes = new ArrayCollection();
    }

    /**
     * @return Collection|Representation[]
     */
    public function getRepresentations(): Collection
    {
        return $this->representations;
    }

    public function addRepresentation(Representation $representation): self
    {
        if (!$this->representations->contains($representation)) {
            $this->representations[] = $representation;
            $representation->setTheShow($this);
        }

        return $this;
    }

    public function removeRepresentation(Representation $representation): self
    {
        if ($this->representations->removeElement($representation)) {
            // set the owning side to null (unless already changed)
            if ($representation->getTheShow() === $this) {
                $representation->setTheShow(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArtistsTypes[]
     */
    public function getArtistTypes(): Collection
    {
        return $this->artistTypes;
    }

    public function addArtistType(ArtistsTypes $artistType): self
    {
        if (!$this->artistTypes->contains($artistType)) {
            $this->artistTypes[] = $artistType;
        }

        return $this;
    }

    public function removeArtistType(ArtistsTypes $artistType): self
    {
        $this->artistTypes->removeElement($artistType);

        return $this;
    }
}
