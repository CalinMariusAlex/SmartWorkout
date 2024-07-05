<?php

namespace App\Service;

use App\Entity\Exercise;
use App\Repository\ExerciseRepository;

class ExerciseService
{

    private ExerciseRepository $exerciseRepository;

    /**
     * @param ExerciseRepository $exerciseRepository
     */
    public function __construct(ExerciseRepository $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    public function getExerciseById($exerciseId): object
    {
        return $this->exerciseRepository->find($exerciseId);
    }

    public function getExercises(): array
    {
        return $this->exerciseRepository->findAll();
    }

    public function saveExercise(Exercise $exercise):void
    {
        $this->exerciseRepository->saveExercise($exercise);
    }

    public function deleteExercise(Exercise $exercise)
    {
        $this->exerciseRepository->deleteExercise($exercise);
    }

    public function checkExerciseExists(Exercise $exercise): array
    {
        $exercises = $this->exerciseRepository->checkExerciseExists($exercise->getName(), $exercise->getId());
        if(!!$exercises)
        {
            return ['save' => false];
        }
        $this->exerciseRepository->saveExercise($exercise);
        return ['save' => true];
    }

    public function checkExerciseExistsOnlyByName(Exercise $exercise): array
    {
        $exercises = $this->exerciseRepository->checkExerciseExistsByName($exercise->getName());
        if(!!$exercises)
        {
            return ['save' => false];
        }
        $this->exerciseRepository->saveExercise($exercise);
        return ['save' => true];
    }

}