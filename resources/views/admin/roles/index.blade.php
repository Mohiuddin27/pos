@extends('admin.layout.master')
@section('content')
    <style>
        .partyy .dropdown-menu {
            min-width: 80px !important;
            margin-top: 40px !important;
            margin-left: 25px !important;
        }

        table, th, td {
        border: 1px solid black;
        border-collapse: collapse; 
        }
        thead{
            background-color:rgba(128, 128, 128, 0.144);
        }
    .dataTables_length label{
        margin-bottom:30px;
    }
        .swal2-cancel{
            margin-right:30px!important;
        }
        .table>tbody>tr>td {
    vertical-align: top!important;
}
    </style>
    <main class="content">
        <div class="container-fluid p-0">
            <h3><strong>All Roles</strong></h3>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">All Roles</h4>
                                            <div></div>
                                            <div>
                                                @if (Auth::guard('admin')->user()->can('role.create'))
                                                    <a href="{{ route('roles.create') }}"
                                                        class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                            aria-hidden="true"></i> Add New Role</a>
                                                @endif
                                            </div>
                                        </div>
                                        <br>

                                        <div class="card-body" style="margin-top:-40px!important;">
                                            @include('sweetalert::alert')

                                            <table class="table table-data">
                                                <thead>
                                                    <tr style="margin-top:20px!important">
                                                        <th style="width:10%">SL</th>
                                                        <th style="width:20%">Name</th>
                                                        <th style="width:50%" class="text-center">Permissions</th>
                                                        <th class="text-center" style="width:20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($roles as $role)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $role->name }}</td>
                                                            <td class="text-center">
                                                                @foreach ($role->permissions as $permission)
                                                                    <span
                                                                        class="badge bg-info mr-2">{{ $permission->name }}</span>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <div class="dropdown partyy text-center">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu" style="text-align: center"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        @if (Auth::guard('admin')->user()->can('role.edit'))
                                                                            <li> <a href="{{ route('roles.edit', $role->id) }}"
                                                                                    class="btn btn-light btn-sm dropdown-item"><i
                                                                                        class="fa fa-pencil-square-o  text-dark"
                                                                                        aria-hidden="true"
                                                                                        style="font-size:18px"> Edit</i></a>
                                                                            </li>
                                                                        @endif
                                                                        @if (Auth::guard('admin')->user()->can('role.delete'))
                                                                            <li>
                                                                                <form
                                                                                    action="{{ route('roles.destroy', $role->id) }}"
                                                                                    method="POST">
                                                                                    @method('DELETE')
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-light btn-sm dropdown-item deleteRole"><i
                                                                                            class="fa fa-trash text-dark"
                                                                                            aria-hidden="true"
                                                                                            style="font-size:18px">
                                                                                            Delete</i></button>
                                                                                </form>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

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
        //DATATABLE
        $(document).ready(function() {
            $('table.table-data').DataTable();
            // $('#partytype').select2();

        });
        $('.deleteRole').click(function(e) {
            var form = $(this).closest("form");

            e.preventDefault();
            // return confirm('Are You Sure to Delete?')
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Role has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'The Role is safe :)',
                        'error'
                    )
                }
            });


        });
    </script>
@endsection
