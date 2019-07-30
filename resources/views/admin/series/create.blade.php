@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Create course series</h2>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">Create Course</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-12 col-form-label text-md-left">Title</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title"
                                    value="{{ old('title') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-12 col-form-label text-md-left">Description</label>

                            <div class="col-md-12">
                                <input id="description" type="description" class="form-control" name="description"
                                    value="{{ old('description') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1" class="btn btn-default">Upload cover image <i class="material-icons">cloud_upload</i><label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>

                        <div class="form-group row text-center">
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary">Create Course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
