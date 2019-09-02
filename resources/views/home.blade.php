@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="container mb-5">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Dashboard</h4>
                            <ul class="list-group">
                                <li class="list-group-item"><a href="#"><i class="material-icons">bookmarks</i> Booksmarks</a></li>
                                <li class="list-group-item"><a href="#"><i class="material-icons">chrome_reader_mode</i> Manage Courses</a></li>
                                <li class="list-group-item"><a href="#"><i class="material-icons">build</i> User Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @foreach ($series as $s)
                    @hasStartedSeries($s)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>{{$s->title}}</h4>
                                    <div class="progress-container progress-primary">
                                        <span class="progress-badge disabled">Completed</span>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ auth()->user()->percentageCompletedForSeries($s) }}%;">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="disabled">Lessons: {{ auth()->user()->getNumberOfCompletedLessonsInSeries($s) }} /
                                        {{ $s->getAllLessonsInSeriesCount() }}</p>
                                    <a href="{{ route('series.learning', $s->slug) }}"
                                        class="btn btn-primary mt-3">Continue
                                        Series</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endhasStartedSeries
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
