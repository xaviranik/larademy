<?php

namespace App\Entities;

use Illuminate\Support\Facades\Redis;

trait Learning {

    public function completeLesson($lesson)
    {
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    public function percentageCompletedForSeries($series)
    {
        $numberOfLessonsInSeries = $series->lesson->count();
        $numberOfCompletedLessonsInSeries = $this->numberOfCompletedLessonsInSeries($series);

        return ($numberOfCompletedLessonsInSeries / $numberOfLessonsInSeries) * 100;
    }

    public function numberOfCompletedLessonsInSeries($series)
    {
        return count(Redis::smembers("user:{$this->id}:series:{$series->id}"));
    }

    public function hasStartedSeries($series)
    {
        return $this->numberOfCompletedLessonsInSeries($series) > 0;
    }
}