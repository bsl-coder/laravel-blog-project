@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Blog Insert Page</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">Create New Blog</div>
            <div class="card-body">
                <form action="{{ route('blog.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" >Image</label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >

                         @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" >Title</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" >

                         @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" >Category</label>
                      <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach

                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Submit Date</label>
                      <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" >

                         @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Description</label>
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote"  rows="10"></textarea>

                         @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    {{-- <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

  <script>
    $(document).ready(function() {
    $('#summernote').summernote();
  });
    </script>

@endsection
