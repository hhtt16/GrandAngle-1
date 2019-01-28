<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkTypeRepository")
 */
class WorkType
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
    private $wording;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Work", mappedBy="workType")
     */
    private $work;

    public function __construct()
    {
        $this->work = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Work[]
     */
    public function getWork(): Collection
    {
        return $this->work;
    }

    public function addWork(Work $work): self
    {
        if (!$this->work->contains($work)) {
            $this->work[] = $work;
            $work->setWorkType($this);
        }

        return $this;
    }

    public function removeWork(Work $work): self
    {
        if ($this->work->contains($work)) {
            $this->work->removeElement($work);
            // set the owning side to null (unless already changed)
            if ($work->getWorkType() === $this) {
                $work->setWorkType(null);
            }
        }

        return $this;
    }
}
