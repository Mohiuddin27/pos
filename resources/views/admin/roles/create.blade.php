@extends('admin.layout.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h3><strong>Roles</strong></h3>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Add New Roles</h4>
                                            <div></div>
                                            <div>
                                                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm mb-3"><i
                                                        class="fa fa-plus-circle" aria-hidden="true"></i> All Roles</a>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="card-body">
                                       @include('admin.layout.partials.errorMessage')
                                       {{-- @if(Session::has('success'))
                                           <p class="alert alert-success d-flex justify-content-between">{{Session::get('success')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
                                       @endif --}}
                                            <form action="{{ route('roles.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="" class="text-dark mb-2"><Strong>Role
                                                            Name</Strong></label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Enter Role Name">
                                                        @error('name')
                                                        <div class="text-danger">* {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for=""
                                                        class="text-dark mb-2"><strong>Permissions</strong></label>
                                                    
                                                    <div class="form-check mt-3">
                                                        <input type="checkbox"
                                                            class="form-check-input" value="1"
                                                            id="checkPermissionAll">
                                                        <label for="checkPermissionAll"
                                                            class="text-dark mb-2">All</label>
                                                    </div> 
                                                    <hr>
                                                    @php $i = 1; @endphp
                                                    @foreach ($permission_groups as $group)
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                                    <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                                                </div>
                                                            </div>
                        
                                                            <div class="col-9 role-{{ $i }}-management-checkbox">
                                                                @php
                                                                    $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                                                    $j = 1;
                                                                @endphp
                                                                @foreach ($permissions as $permission)
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                                    </div>
                                                                    @php  $j++; @endphp
                                                                @endforeach
                                                                <br>
                                                            </div>
                        
                                                        </div>
                                                        @php  $i++; @endphp
                                                    @endforeach

                                                   
                                                </div>
                                                <button type="submit" class="btn btn-primary float-end mt-4 pr-4 pl-4"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
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
    $("#checkPermissionAll").click(function(){
        if($(this).is(':checked')){
            //check all the input
            $('input[type=checkbox').prop('checked',true);
        }else{
            $('input[type=checkbox').prop('checked',false);

        }
    });

    function checkPermissionByGroup(className, checkThis){
        const groupIdName=$("#"+checkThis.id);
        const classCheckBox=$('.'+className+' input');
        if(groupIdName.is(':checked')){
            //check all the input
            classCheckBox.prop('checked',true);
        }else{
            classCheckBox.prop('checked',false);

        }

    }
    
</script>
@endsection