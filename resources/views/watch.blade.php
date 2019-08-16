@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
</div>
<div class="container mb-4">
    <div class="row">
        <div class="col-md-12">
            <vue-player default_lesson="{{ $lesson }}"
                next_lesson_url="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $lesson->getNextLesson()->id]) }}">
            </vue-player>
        </div>
    </div>

    <div class="row justify-content-between px-3 py-2">
        @if ($lesson->getPreviousLesson())
        <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $lesson->getPreviousLesson()->id]) }}"
            class="btn btn-primary"><i class="material-icons">chevron_left</i> Previous Lesson</a>
        @else
        <a href="#" class="btn btn-primary disabled"><i class="material-icons">chevron_left</i> Previous Lesson</a>
        @endif
        @if ($lesson->getNextLesson())
        <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $lesson->getNextLesson()->id]) }}"
            class="btn btn-primary">Next Lesson <i class="material-icons">chevron_right</i></a>
        @else
        <a href="#" class="btn btn-outline-primary">Finish Series</a>
        @endif
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="title">{{ $lesson->title }}</h4>
                    <p>{{ $lesson->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="title mb-0">All Lessons</h4>
                    <ul class="list-group">
                        @foreach ($series->getOrderedLessons() as $l)
                        <li class="list-group-item p-3">
                            <a style="line-height: initial;"
                                href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $l->id]) }}">{{ $l->episode_number . ". " .$l->title }}</a>
                            <hr>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
