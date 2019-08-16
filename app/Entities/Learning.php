<?php

namespace App\Entities;

use Illuminate\Support\Facades\Redis;
use App\Lesson;

trait Learning {

    public function completeLesson($lesson)
    {
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    public function percentageCompletedForSeries($series)
    {
        $numberOfLessonsInSeries = $series->lesson->count();
        $getNumberOfCompletedLessonsInSeries = $this->getNumberOfCompletedLessonsInSeries($series);

        return ($getNumberOfCompletedLessonsInSeries / $numberOfLessonsInSeries) * 100;
    }
    
    public function hasStartedSeries($series)
    {
        return $this->getNumberOfCompletedLessonsInSeries($series) > 0;
    }

    public function getNumberOfCompletedLessonsInSeries($series)
    {
        return count($this->getCompletedLessonsInSeries($series));
    }

    public function getCompletedLessonsInSeries($series)
    {
        return Redis::smembers("user:{$this->id}:series:{$series->id}");
    }

    public function getCompletedLessons($series)
    {
        $completedLessons = $this->getCompletedLessonsInSeries($series);
        
        return collect($completedLessons)->map(function($lessonId) {
            return Lesson::find($lessonId);
        });
    }

    public function hasCompletedLesson($lesson)
    {
        return in_array($lesson->id, $this->getCompletedLessonsInSeries($lesson->series));
    }
}