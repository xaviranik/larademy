@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Let's Learn Something</h2>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary bg-gredient-primary">
                    <h4>{{$series->title}}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="disabled mt-4">{{ $series->description }}</p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="mt-4">
                            @if (auth()->user())
                                @if (auth()->user()->hasStartedSeries($series))
                                    <a href="#" class="btn btn-primary">Continue Series</a>
                                @else
                                    <a href="#" class="btn btn-primary">Start Series</a>
                                @endif
                            @else
                                <a href="#" class="btn btn-primary">Login to get started</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
