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
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Image</label>
                      <input type="file" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Title</label>
                      <input type="text" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Category</label>
                      <input type="text" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Submit Date</label>
                      <input type="date" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Description</label>
                      <textarea name="" class="form-control" id=""  rows="5"></textarea>
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
