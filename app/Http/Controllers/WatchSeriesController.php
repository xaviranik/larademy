<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Series;
use Illuminate\Http\Request;

class WatchSeriesController extends Controller
{
    public function index(Series $series)
    {
        return redirect()->route('series.watch', [
            'series' => $series->slug,
            'lesson' => $series->lesson->first()->id
        ]);
    }

    public function showLesson(Series $series, Lesson $lesson)
    {
        return view('watch', [
            'series' => $series,
            'lesson' => $lesson
        ]);
    }

    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->completeLesson($lesson);
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
