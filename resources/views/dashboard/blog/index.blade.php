@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Blog Page</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="card">
        <div class="card-header">Blog List</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center table-image mt-3">
                <thead class="table-dark">
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Image</th>
                      <th scope="col">Author Name</th>
                      <th scope="col">Title</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($blogs as $blog)

                    <tr>
                      <th scope="row">{{ $loop->index + 1 }}</th>
                      <td>
                        <img class="img-fluid img-thumbnail"  src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt=""width="100px" height="100px">
                      </td>
                      <td>{{ $blog->RelationwithUser->name }}</td>
                      <td>{{ $blog->title }}</td>
                      <td>{{ $blog->RelationwithCategory->title }}</td>
                      <td>edit</td>
                      <td>delete</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center text-danger" colspan="7">No Data Found</td>
                    </tr>
                    @endforelse

                  </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


@section('footer_script')

@if (session('blog_success'))
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
        title: "{{ session('blog_success') }}"
        })

    </script>
@endif

@endsection
