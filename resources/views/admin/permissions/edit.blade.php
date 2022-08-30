@extends('admin.layout.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h3><strong>Permission</strong></h3>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Edit Permission -> {{$permission->name}}</h4>
                                            <div></div>
                                            <div>
                                                <a href="{{ route('permission.index') }}" class="btn btn-primary btn-sm mb-3"><i
                                                        class="fa fa-plus-circle" aria-hidden="true"></i> All Permission</a>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="card-body">
                                            @include('sweetalert::alert')

                                            <form action="{{ route('permission.update',$permission->id) }}" method="POST">
                                            
                                                @csrf
                                                <div class="row"> 
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2"><Strong>Permission
                                                                Name</Strong></label>
                                                        <input type="text" name="name" value="{{$permission->name}}"class="form-control @error('name') is-invalid @enderror"
                                                            placeholder="Enter Permission Name">
                                                            @error('name')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="text-dark mb-2"><Strong>Permission
                                                                Group Name</Strong></label>
                                                        <input type="text" name="group_name" value="{{$permission->group_name}}"class="form-control @error('group_name') is-invalid @enderror"
                                                            placeholder="Enter Permission Group Name">
                                                            @error('group_name')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                </div>
                                                
                                                <div class="row"> 
                                                    <div class="form-group col-md-6 mt-3">
                                                        <label for="" class="text-dark mb-2"><Strong>Assign
                                                                Roles</Strong></label><br>
                                                        <select name="roles[]" id="roles" class="select2 w-100" multiple required>
                                                            @foreach ($roles as $role)
                                                            <option value="{{$role->name}}"  {{$permission->hasRole($role->name) ? 'selected':''}}>{{$role->name}}</option>
                                                                
                                                            @endforeach
                                                        </select>
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
    
</script>
@endsection