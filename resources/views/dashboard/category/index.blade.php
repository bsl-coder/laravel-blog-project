@extends('layouts.dashboard_master')

@section('content')


<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Categories</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">Category List</div>
            <div class="card-body table-responsive  ">
                <table class="table table-bordered text-center table-image mt-3">
                    <thead class="table-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Image</th>
                          <th scope="col">Title</th>
                          <th scope="col">Slug</th>
                          <th scope="col">Status</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $categories->firstItem() + $loop->index  }}</th>
                            <td >
                              <img class="img-fluid img-thumbnail"  src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="">
                            </td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <form action="{{ route('category.status.change',$category->id) }}" method="post">
                                    @csrf
                                    @if ( $category->status == 'active')
                                        <button type="submit" class="btn btn-success">{{ $category->status }}</button>
                                     @else
                                        <button type="submit" class="btn btn-danger">{{ $category->status }}</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryEdit{{$category->id}}" >Edit</button>
                            </td>
                            <td>
                                <form action="{{ route('category.delete',$category->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                          </tr>
                          {{-- Modal  --}}
                        <div class="modal fade" id="categoryEdit{{$category->id}}" tabindex="-1" aria-labelledby="categoryEditLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Category Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('category.edit',$category->id) }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="">
                                          <label  class="form-label">Category Title</label>
                                          <input type="text"  class="form-control  " name="title" value="{{$category->title}}" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        {{-- Modal end  --}}
                        @endforeach
                    </tbody>
                    {{ $categories->links() }}
                    </table>

            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">Category Insert</div>
            <div class="card-body">
                <form action="{{ route('category.insert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label">Category Title</label>
                      <input type="text"  class="form-control @error('title') is-invalid @enderror " name="title" >
                      @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Category Slug</label>
                      <input type="text"  class="form-control @error('slug') is-invalid @enderror " name="slug" >
                      @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label  class="form-label   ">Category Image</label><br>

                      <input type="file"  class="form-control @error('image') is-invalid @enderror " name="image" >
                      @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Insert</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('footer_script')

@if (session('category_success'))
    <script>

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: "{{ session('category_success') }}"
        })

    </script>
@endif

@endsection
