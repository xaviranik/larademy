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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary bg-gredient-primary">
                    <h4>{{ $lesson->title }}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <vue-player></vue-player>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
