<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sex")
     */
    private $sexes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="father")
     */
    private $fathers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Person", mappedBy="fathers")
     */
    private $father;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="mother")
     */
    private $mothers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Person", mappedBy="mothers")
     */
    private $mother;

    public function __construct()
    {
        $this->sexes = new ArrayCollection();
        $this->father = new ArrayCollection();
        $this->mother = new ArrayCollection();
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

   

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection|Sex[]
     */
    public function getSexes(): Collection
    {
        return $this->sexes;
    }

    public function addSex(Sex $sex): self
    {
        if (!$this->sexes->contains($sex)) {
            $this->sexes[] = $sex;
        }

        return $this;
    }

    public function removeSex(Sex $sex): self
    {
        if ($this->sexes->contains($sex)) {
            $this->sexes->removeElement($sex);
        }

        return $this;
    }

    public function getFathers(): ?self
    {
        return $this->fathers;
    }

    public function setFathers(?self $fathers): self
    {
        $this->fathers = $fathers;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFather(): Collection
    {
        return $this->father;
    }

    public function addFather(self $father): self
    {
        if (!$this->father->contains($father)) {
            $this->father[] = $father;
            $father->setFathers($this);
        }

        return $this;
    }

    public function removeFather(self $father): self
    {
        if ($this->father->contains($father)) {
            $this->father->removeElement($father);
            // set the owning side to null (unless already changed)
            if ($father->getFathers() === $this) {
                $father->setFathers(null);
            }
        }

        return $this;
    }

    public function getMothers(): ?self
    {
        return $this->mothers;
    }

    public function setMothers(?self $mothers): self
    {
        $this->mothers = $mothers;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMother(): Collection
    {
        return $this->mother;
    }

    public function addMother(self $mother): self
    {
        if (!$this->mother->contains($mother)) {
            $this->mother[] = $mother;
            $mother->setMothers($this);
        }

        return $this;
    }

    public function removeMother(self $mother): self
    {
        if ($this->mother->contains($mother)) {
            $this->mother->removeElement($mother);
            // set the owning side to null (unless already changed)
            if ($mother->getMothers() === $this) {
                $mother->setMothers(null);
            }
        }

        return $this;
    }
}
