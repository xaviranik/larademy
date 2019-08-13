@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand text-center">
                    <h1>Learn by Doing</h1>
                    <h3 class="title text-center">Learn the latest tech skills to propel your career forward</h3>
                    <a href="/register" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="text-center py-4">
            <h3>Browse Courses</h3>
        </div>
        <div class="row">
            @forelse ($series as $s)
                <div class="col-md-12">
                    <div class="course-card mb-4" style="background-image: url({{ $s->image_path }})">
                        <h3 class="mb-4">{{ $s->title }}</h3>
                        <p>{{ $s->description }}</p>
                        <a href="{{ route('series', $s->slug) }}" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
</div>
@endsection
