@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Tags</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    Tag List
                </div>
                <div class="">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tagRestore" >
                        <i class="material-icons-two-tone" >restore</i>Restore</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="tagRestore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered text-center">
                                <thead class="table-dark">
                                  <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Restore</th>
                                    <th scope="col">Permanent Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($trashed as $t)
                                    <tr>
                                      <th scope="row">{{ $t->id }}</th>
                                      <td>{{ $t->title }}</td>
                                      <td>
                                        <form action="{{ route('tag.restore',$t->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" >Restore</button>
                                        </form>
                                      </td>
                                      <td>
                                        <form action="{{ route('tag.forced.delete',$t->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" >Delete</button>
                                        </form>
                                      </td>
                                    </tr>
                                  @endforeach

                                </tbody>
                              </table>
                        </div>
                        {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                    </div>
                    </div>
                </div>
                <!-- Modal -->

            </div>
            <div class="card-body table-responsive  ">
                <table class="table table-bordered text-center table-image mt-3">
                    <thead class="table-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Title</th>
                          <th scope="col">Status</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tags as $tag)

                        <tr>
                            <th scope="row">{{ $tags->firstItem() + $loop->index }}</th>
                            <td>{{ $tag->title }}</td>
                            <td>
                                <form action="{{ route('tag.status.change',$tag->id) }}" method="post">
                                    @csrf
                                    @if ($tag->status == 'active')
                                    <button type="submit" class="btn btn-success">{{ $tag->status }}</button>
                                    @else
                                    <button type="submit" class="btn btn-danger">{{ $tag->status }}</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagEdit{{$tag->id}}" >Edit</button>
                            </td>
                            <td>
                                <form action="{{ route('tag.delete',$tag->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" >Delete</button>
                                </form>
                            </td>
                        </tr>
                        {{-- Modal  --}}
                        <div class="modal fade" id="tagEdit{{$tag->id}}" tabindex="-1" aria-labelledby="categoryEditLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tag Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('tag.edit',$tag->id) }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="">
                                          <label  class="form-label">Tag Title</label>
                                          <input type="text"  class="form-control  " name="title" value="{{$tag->title}}" >
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
                      {{ $tags->links() }}
                </table>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">Tag Insert</div>
            <div class="card-body">
                <form action="{{ route('tag.insert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label">Tag Title</label>
                      <input type="text"  class="form-control @error('title') is-invalid @enderror " name="title" >
                      @error('title')
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

@if (session('tag_success'))
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
        title: "{{ session('tag_success') }}"
        })

    </script>
@endif

@endsection



