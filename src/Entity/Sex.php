<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SexRepository")
 */
class Sex
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Person")
     */
    private $sexes;

    public function __construct()
    {
        $this->sexes = new ArrayCollection();
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
     * @return Collection|Person[]
     */
    public function getSexes(): Collection
    {
        return $this->sexes;
    }

    public function addSex(Person $sex): self
    {
        if (!$this->sexes->contains($sex)) {
            $this->sexes[] = $sex;
        }

        return $this;
    }

    public function removeSex(Person $sex): self
    {
        if ($this->sexes->contains($sex)) {
            $this->sexes->removeElement($sex);
        }

        return $this;
    }
}
