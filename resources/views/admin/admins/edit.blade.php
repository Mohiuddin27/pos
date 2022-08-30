@extends('admin.layout.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h3><Strong>Admins</strong></h3>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Edit Admin -> {{$admin->name}}</h4>
                                            <div></div>
                                            <div>
                                                <a href="{{ route('admins.index') }}" class="btn btn-primary btn-sm mb-3"><i
                                                        class="fa fa-plus-circle" aria-hidden="true"></i> All Admins</a>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="card-body">
                                            @include('sweetalert::alert')
                                            <form action="{{ route('admins.update',$admin->id) }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="row"> 
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2"><Strong>Admin
                                                                Name</Strong></label>
                                                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                                                            placeholder="Enter Name" value="{{$admin->name}}">
                                                            @error('name')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2 "><Strong>Admin
                                                                Email</Strong></label>
                                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                                            placeholder="Enter Email" value="{{$admin->email}}">
                                                            @error('email')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2 mt-2"><Strong>Admin
                                                                Password</Strong></label>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Enter Password" >
                                                            @error('password')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2 mt-2"><Strong>Admin
                                                                Confirm Password</Strong></label>
                                                        <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror"
                                                            placeholder="Confirm Password">
                                                        </div>
                                                        @error('password_confirmation')
                                                        <div class="text-danger">* {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="row"> 
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2 mt-2"><Strong>Assign
                                                                Roles</Strong></label><br>
                                                        <select name="roles[]" id="roles" class="select2 w-100" multiple required>
                                                            @foreach ($roles as $role)
                                                            <option value="{{$role->name}}" {{$admin->hasRole($role->name) ? 'selected':''}}>{{$role->name}}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2 mt-2"><Strong>Admin
                                                                Username</Strong></label>
                                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$admin->username}}"
                                                            placeholder="Enter Username">
                                                            @error('username')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label style="font-size:70px;cursor: pointer;" for="imageedit"><i
                                                                class="fa fa-file-image-o mb-2"></i></label>
                                                        <input type="file" name="image" id="imageedit" style="display:none">
                                                        <img style="max-width:50%;display:block"id="product_image_edit"
                                                            src="{{ URL::to('/') }}/media/admins/{{ $admin->image }}" alt="">
                                                    </div>
                                                </div>
                                               
                                                <button type="submit" class="btn btn-primary float-end mt-4 pr-4 pl-4"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                                            </form>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
    </main>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('.select2').select2();
});
$(document).on('change', "input#imageedit", function(e) {
            e.preventDefault();
            let product_image_url = URL.createObjectURL(e.target.files[0]);
            $('img#product_image_edit').attr('src', product_image_url);
        });
    
</script>
@endsection