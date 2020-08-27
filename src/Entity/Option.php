<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
class Option
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
     * @ORM\ManyToMany(targetEntity=Nanny::class, mappedBy="options")
     */
    private $nannies;

    public function __construct()
    {
        $this->nannies = new ArrayCollection();
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

    /**
     * @return Collection|Nanny[]
     */
    public function getNannies(): Collection
    {
        return $this->nannies;
    }

    public function addNanny(Nanny $nanny): self
    {
        if (!$this->nannies->contains($nanny)) {
            $this->nannies[] = $nanny;
        }

        return $this;
    }

    public function removeNanny(Nanny $nanny): self
    {
        if ($this->nannies->contains($nanny)) {
            $this->nannies->removeElement($nanny);
        }

        return $this;
    }
}
