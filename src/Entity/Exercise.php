<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    //#[ORM\Column(length: 100)]
    //private ?string $type = null;
    #[ORM\OneToMany(mappedBy: 'exercise', targetEntity: Exercise::class)]
    private Collection $exerciseLogs;

    /**
     * @var Collection<int, MuscleGroup>
     */
    #[ORM\OneToMany(targetEntity: MuscleGroup::class, mappedBy: 'relation')]
    private Collection $muscleGroups;

    public function __construct()
    {
        $this->muscleGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, MuscleGroup>
     */
    public function getMuscleGroups(): Collection
    {
        return $this->muscleGroups;
    }

    public function addMuscleGroup(MuscleGroup $muscleGroup): static
    {
        if (!$this->muscleGroups->contains($muscleGroup)) {
            $this->muscleGroups->add($muscleGroup);
            $muscleGroup->setRelation($this);
        }

        return $this;
    }

    public function removeMuscleGroup(MuscleGroup $muscleGroup): static
    {
        if ($this->muscleGroups->removeElement($muscleGroup)) {
            // set the owning side to null (unless already changed)
            if ($muscleGroup->getRelation() === $this) {
                $muscleGroup->setRelation(null);
            }
        }

        return $this;
    }
}
