@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
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
                            @auth
                                @hasStartedSeries($series)
                                    <a href="{{ route('series.learning', $series->slug) }}" class="btn btn-primary">Continue Series</a>
                                @else
                                    <a href="{{ route('series.learning', $series->slug) }}" class="btn btn-primary">Start Series</a>
                                @endhasStartedSeries
                            @else
                                <a href="#" class="btn btn-primary">Login to get started</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
