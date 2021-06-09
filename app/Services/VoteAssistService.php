<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\Vote;

class VoteAssistService
{
    protected $allAssists = null;

    public function getForSubject(Subject $subject): array
    {
        $assists = $this->getAll();
        if (empty($assists[$subject->id])) {
            return [];
        }

        return $assists[$subject->id];
    }

    public function getAll(): array
    {
        if ($this->allAssists === null) {
            $this->allAssists = [];
            $votes = Vote::all();
            foreach ($votes as $vote) {
                if (!empty($vote->extra['help'])) {
                    if ($vote->extra['assist'] === null && $vote->extra['help'] === ['18']) {
                        continue;
                    }
                    foreach ($vote->extra['help'] as $subjectId) {
                        $this->allAssists[$subjectId][] = $vote;
                    }
                }
            }
        }

        return $this->allAssists;
    }
}
