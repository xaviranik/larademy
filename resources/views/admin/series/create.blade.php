@extends('layouts.app')

@section('content')
<div class="main main-raised page-header x-header mb-4">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Create Course Series</h2>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">Create Course</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('series.store') }}" enctype="multipart/form-data">
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

                        <div class="input-group row">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input btn btn-default" id="inputGroupFile02" />
                                <label class="custom-file-label col-md-12 col-form-label text-md-left" for="inputGroupFile02">Choose Cover Image</label>
                            </div>
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
