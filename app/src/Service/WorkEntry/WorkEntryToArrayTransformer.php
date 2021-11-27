<?php

namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;

class WorkEntryToArrayTransformer
{
    public function get(WorkEntry $workEntry): array
    {
        return [
            'id' => $workEntry->getId(),
            'userId' => $workEntry->getUser()->getId(),
            'startAt' => $workEntry->getStartDate()->format('Y-m-d H:i:s'),
            'endAt' => $workEntry->getEndDate()->format('Y-m-d H:i:s'),
        ];
    }
}