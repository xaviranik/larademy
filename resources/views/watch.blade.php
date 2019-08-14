@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
</div>
<div class="container mb-4">
    <div class="row">
        <div class="col-md-12">
            <vue-player default_lesson="{{ $lesson }}"></vue-player>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="title">{{ $lesson->title }}</h4>
                    <p>{{ $lesson->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
