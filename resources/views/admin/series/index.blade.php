@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">{{ $series->title }}</h2>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary bg-gredient-primary">
                    Customize your course series
                </div>

                <div class="card-body">
                    <vue-lessons default_lessons="{{ $series->lesson }}" series_id="{{ $series->id }}"></vue-lessons>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
