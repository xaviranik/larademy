@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Manage All Your Series</h2>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary bg-gredient-primary">All Series</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th class="col-md-10">Title</th>
                            <th class="col-md-1">Edit</th>
                            <th class="col-md-1">Delete</th>
                        </thead>
                        <tbody>
                            @forelse ($series as $s)
                            <tr>
                                <td>{{ $s->title }}</td>
                                <td><a href="#" class="button-icon text-primary"><i class="material-icons">create</i></a></td>
                                <td><a href="#" class="button-icon text-danger"><i class="material-icons">delete_forever</i></a></td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
