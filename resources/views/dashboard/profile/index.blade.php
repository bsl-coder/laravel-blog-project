@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Profile</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">Image Update</div>
            <div class="card-body">
                <form action="{{route('profile.image',auth()->id())}}" method="post" enctype="multipart/form-data" class="d-flex align-items-center justify-content-center flex-column">
                    @csrf
                    <div class="mb-3 text-center ">
                        <img src="{{ asset('uploads/profile') }}/{{auth()->user()->image}}" class=" img-fluid rounded-circle img-thumbnail img-xs user-profile-image center mb-3 " style="width : 150px; height: 150px; " >

                        <br>
                      <label  class="form-label mt-3  ">Upload your new profile image</label>
                      <input type="file"  class="form-control @error('image') is-invalid @enderror " name="image" >
                      @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-success">Update</button>
                  </form>
            </div>
        </div>
    </div>


    <div class="col-6">
        <div class="card">
            <div class="card-header">Name Update</div>
            <div class="card-body">
                <form action="{{route('profile.name',auth()->id())}}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label">Username</label>
                      <input type="text" placeholder="{{auth()->user()->name}}" class="form-control @error('name') is-invalid @enderror " name="name" >
                      @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-success">Update</button>
                  </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">Email Update</div>
            <div class="card-body">
                <form action="{{route('profile.email',auth()->id())}}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label">User email</label>
                      <input type="email" placeholder="{{auth()->user()->email}}" class="form-control @error('email') is-invalid @enderror " name="email" >
                      @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-success">Update</button>
                  </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">Password Update</div>
            <div class="card-body">
                <form action="{{route('profile.password',auth()->id())}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label">Current Password</label>
                        <input type="password"  class="form-control @error('current_password') is-invalid @enderror " id="password" name="current_password" >

                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">New Password</label>
                        <input type="password" id="password"  class="form-control @error('password') is-invalid @enderror " name="password" >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Confirm Password</label>
                        <input type="password"  class="form-control" name="password_confirmation" >

                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                  </form>

            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_script')

@if (session('update_success'))
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
        title: "{{ session('update_success') }}"
        })

    </script>
@endif

@if (session('update_error'))
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
        icon: 'error',
        title: "{{ session('update_error') }}"
        })

    </script>
@endif



@endsection
