<?php

namespace App\Service;

use App\Entity\MuscleGroup;
use App\Repository\MuscleGroupRepository;
use function PHPUnit\Framework\throwException;

class MuscleGroupService
{

    private MuscleGroupRepository $muscleGroupRepository;
    public function __construct(MuscleGroupRepository $muscleGroupRepository)
    {
        $this->muscleGroupRepository = $muscleGroupRepository;
    }

    public function saveMuscleGroup(MuscleGroup $muscleGroup): array
    {
        try {
            if($this->muscleGroupRepository->checkMuscleGroup($muscleGroup))
            {
                throw new \Exception("MuscleGroup already exists");
            }
            $this->muscleGroupRepository->saveMuscleGroup($muscleGroup);
            return ['success'=>true];
        }
        catch (\Exception $e) {
            return ['error'=>true, 'message'=>$e->getMessage()];
        }

       /* if($this->muscleGroupRepository->checkMuscleGroup($muscleGroup))
        {
            return ['error'=>true, 'message'=>'Muscle group already exists.'];
        }
        $this->muscleGroupRepository->saveMuscleGroup($muscleGroup);
        return ['error'=>false, 'message'=>'Muscle group saved.'];*/
    }
}