@extends('admin.layout.master')
@section('content')
<style>
     .partyy .dropdown-menu{
        min-width: 80px!important;
        margin-top:40px!important;
        margin-left:30px!important;
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
  </style>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Party Type</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">All Party Type</h4>
                                            <div></div>
                                            <div>
                                                @if(Auth::guard('admin')->user()->can('party.type.create'))
                                                <a href="#partytype-modal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Party Type</a>
                                                @endif
                                            </div>
                                        </div>
                                       <br>
                                        <div class="messs"></div>
                                        @if (Session::has('success'))
                                            <p class="alert alert-success d-flex justify-content-between">
                                                {{ Session::get('success') }}<button type="button" class="btn-close"
                                                    data-bs-dismiss="alert" aria-label="Close"></button></p>
                                        @endif
                                        {{-- @include('sweetalert::alert') --}}

                                    </div>
                                    <div class="card-body" style="margin-top:-55px!important;">
                                        <table class="table  table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Party Type Name</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="customercategory">
                                                @foreach ($partytype as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $data->type_name }}</td>
                                                        <td>

                                                            @if($data->status == 'Active')
                                                            <span class="badge bg-success">{{ $data->status }}</span>
                                                            @else
                                                            <span class="badge bg-warning">{{ $data->status }}</span>
                                                            @endif


                                                        </td>

                                                        <td>
                                                            <div class="dropdown partyy text-center">
                                                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" style="text-align: center" aria-labelledby="dropdownMenuButton1">
                                                                    @if(Auth::guard('admin')->user()->can('partytype.edit'))
                                                                  <li>  <a class="btn btn-warning btn-sm dropdown-item text-center" edit_id="{{ $data->id }}"
                                                                    data-bs-toggle="modal" id="edit_party_type"><i
                                                                        class="fa fa-pencil-square-o  text-dark"
                                                                        style="font-size:20px" aria-hidden="true"> Edit</i>
                                                                </a></li>
                                                                @endif
                                                                @if(Auth::guard('admin')->user()->can('partytype.temporary.delete'))
                                                                  <li> <a class="btn btn-light btn-sm dropdown-item text-center" id="delete_party_type"
                                                                    delete_id="{{ $data->id }}" href=""><i
                                                                        class="fa fa-trash text-dark" style="font-size:20px"
                                                                        aria-hidden="true"> Delete</i>
                                                                </a></li>
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
            {{-- add party type --}}

            <div id="partytype-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new Partytype</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        

                        </div>
                       
                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_party_type_form" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="mb-2">Type name</label>
                                    <input name="type_name" class="form-control" id="type_name" type="text"
                                        placeholder="Name">
                                        <span class="text-danger error-text type_name_error"></span>
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="SAVE">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>


            {{-- //edit party type --}}
            <div id="editpartytype-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Partytype</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <form id="updateData" action="" method="POST">
                                {{-- @csrf
                                @method('PUT') --}}
                                <div class="form-group">
                                    <input name="id" id="edit_id" class="form-control" type="hidden"
                                    placeholder="title">
                                    <label for="" class="mb-2">Type name</label>
                                   
                                    <input name="type_name" class="form-control" id="edit_type_name" type="text"
                                        placeholder="Name">
                                    <span class="text-danger error-text type_name_error"></span>
                                </div><br>
                                <div class="form-group">
                                    <label for="" class="mb-2">Status</label>
                                    <br>
                                    <select name="status" class="form-control" style="width:40%" id="edit_status"
                                        >
                                        <option value="">--Select Status--</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>





        </div>
    </main>
   
    
@endsection
@section('script')
<script>
    //create party type

    $(document).on('submit', 'form#add_party_type_form', function(e) {
        e.preventDefault();
        var type_name = $("#type_name").val();
        var fd = new FormData();
        fd.append('type_name',type_name);
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: 'partytype-create',
            method: "POST",
            contentType: false,
            processData: false,
            data:fd,
            dataType:"json",
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(res) {
                if (res.status == 200) {
                    $('#partytype-modal').modal('hide');
                    Swal.fire(
                        'Added',
                        'Party Type Added Successfully!',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);


                }
                else if (res.status === 400) {
                    $.each(res.errors, function(key, err_value) {
                        $('span.' + key + '_error').text(err_value[0]);
                    });
                }

                }
            });
        
    });

    //select2

    //data table

    $(document).ready(function() {
        $('table.table-data').DataTable();
        // $('#partytype').select2();

    });
    //edit party type
    $(document).on('click', '#edit_party_type', function(e) {
        e.preventDefault();

        let edit_id = $(this).attr('edit_id');
        $.ajax({
            url: 'partytype-edit/' + edit_id,
            success: function(data) {
                $('#editpartytype-modal input[id="edit_id"]').val(data.id);
                $('#editpartytype-modal input[id="edit_type_name"]').val(data.type_name);
                $('#editpartytype-modal select[id="edit_status"]').val(data.status);


                $('#editpartytype-modal').modal('show');
            }
        })
    });

   //update single data
   $(document).on('submit', 'form#updateData', function(e) {
        e.preventDefault();
        var id=$('#edit_id').val();
        var edit_type_name = $("#edit_type_name").val();
        var edit_status=$('#edit_status').val();
      
        var fd = new FormData();
        // fd.append('id',id);
        fd.append('type_name',edit_type_name);
        fd.append('status',edit_status);
       
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'partytype-update/'+ id,
            type: "post",
            contentType: false,
            processData: false,
            data:fd,
           
            success: function(res) {
                if (res.status == 200) {
                    $('#editpartytype-modal').modal('hide');
                    Swal.fire(
                        'Update',
                        'Party Type Update Successfully!',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                  }
                  else if (res.status === 400) {
                    $.each(res.errors, function(key, err_value) {
                        $('span.' + key + '_error').text(err_value[0]);
                    });
                }
                }
                
            });      
    });
    //temporary delete
    $(document).on('click', 'a#delete_party_type', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'temporary-delete/' + id,
                    success: function(data) {
                        Swal.fire(
                            'Delete',
                            'Party Type Temporaraly Deleted Successfully!',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);


                    }
                });
            }
        })
    });

    
</script>
@endsection
