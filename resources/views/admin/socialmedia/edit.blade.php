@extends('layouts.admin.master')
@section('title', 'Social Medias')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Social Media</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.socialmedias.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.socialmedias.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Title</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="title" id="" value="{{ old('title', $socialmedia->title) }}" placeholder="">
                                @error('title')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Link</label>
                                <input type="text" class="form-control"
                                    name="link" id="" value="{{ old('link', $socialmedia->link) }}" placeholder=""
                                    autocomplete="off">
                                @error('link')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            
                        </div>
                        
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pencil"></i> Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $(".image").change(function() {
                input = this;
                var nthis = $(this);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        nthis.siblings('.view-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        })
    </script>
@endsection
