@extends('admin.layout.master')
@section('content')
    <style>
        .partyy .dropdown-menu {
            min-width: 80px !important;
            margin-top: 40px !important;
            margin-left: 5px !important;
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

            <h1 class="h3 mb-3"><strong>Warehouse</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">All Warehouse List</h4>
                                            <div></div>
                                            <div>
                                                {{-- @if (Auth::guard('admin')->user()->can('party.type.create')) --}}
                                                <a href="#warehouse-modal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Warehouse</a>
                                                {{-- @endif --}}
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
                                        <table class="table table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Warehouse Name</th>
                                                    <th>Product Name</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($warehouses as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->product->name }}</td>
                                                        <td>

                                                            @if ($data->status == 'Active')
                                                                <span class="badge bg-success">{{ $data->status }}</span>
                                                            @else
                                                                <span class="badge bg-warning">{{ $data->status }}</span>
                                                            @endif


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
                                                                    <li> <a class="btn btn-warning btn-sm dropdown-item text-center"
                                                                            edit_id="{{ $data->id }}"
                                                                            data-bs-toggle="modal" id="edit_warehouse"><i
                                                                                class="fa fa-pencil-square-o  text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Edit</i>
                                                                        </a></li>
                                                                    <li> <a class="btn btn-light btn-sm dropdown-item text-center"
                                                                            id="delete_warehouse"
                                                                            delete_id="{{ $data->id }}"
                                                                            href=""><i class="fa fa-trash text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Delete</i>
                                                                        </a></li>
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
            {{-- add product --}}

            <div id="warehouse-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Warehouse</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                        </div>

                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_warehouse_form" action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Warehouse name</label>
                                            <input name="name" class="form-control" id="name" type="text"
                                                placeholder="Name">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Product</label>

                                            <select name="product_id" class="form-control" id="product_id">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"> {{ $product->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text product_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Current Stock</label>
                                            <input name="current_stock" class="form-control" id="current_stock"
                                                type="number" placeholder="current stock">
                                            <span class="text-danger error-text current_stock_error"></span>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Minimum Stock</label>
                                            <input name="minimum_stock" class="form-control" id="minimum_stock"
                                                type="number" placeholder="Minimum Stock">
                                            <span class="text-danger error-text minimum_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Maximum Stock</label>
                                            <input name="maximum_stock" class="form-control" id="maximum_stock"
                                                type="number" placeholder="Maximum Stock">
                                            <span class="text-danger error-text maximum_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Transfer Id</label>
                                            <input name="transfer_id" class="form-control" id="transfer_id"
                                                type="number" placeholder="Transfer Id">
                                            <span class="text-danger error-text transfer_id_error"></span>
                                        </div>
                                       



                                    </div>
                                  
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Cancel</button>


                                    <input class="btn btn-primary btn-sm"type="submit" value="Save">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>


            {{-- //edit party type --}}
            <div id="editWarehouse-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Warehouse</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <form id="updateData" action="" method="POST">
                                {{-- @csrf
                                @method('PUT') --}}
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="id" id="edit_id" class="form-control" type="hidden"
                                            placeholder="title">
                                            <label for="" class="mb-2">Warehouse name</label>
                                            <input name="name" class="form-control" id="edit_name" type="text"
                                                placeholder="Name">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mt-2 mb-2">Product</label>

                                            <div class="product"></div>
                                            <span class="text-danger error-text product_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Current Stock</label>
                                            <input name="current_stock" class="form-control" id="edit_current_stock"
                                                type="number" placeholder="current stock">
                                            <span class="text-danger error-text current_stock_error"></span>
                                        </div>
                                        


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Minimum Stock</label>
                                            <input name="minimum_stock" class="form-control" id="edit_minimum_stock"
                                                type="number" placeholder="Minimum Stock">
                                            <span class="text-danger error-text minimum_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Maximum Stock</label>
                                            <input name="maximum_stock" class="form-control" id="edit_maximum_stock"
                                                type="number" placeholder="Maximum Stock">
                                            <span class="text-danger error-text maximum_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Transfer Id</label>
                                            <input name="transfer_id" class="form-control" id="edit_transfer_id"
                                                type="number" placeholder="Transfer Id">
                                            <span class="text-danger error-text transfer_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Status</label>
                                            <br>
                                            <select name="status" class="form-control"id="edit_status"
                                                >
                                                <option value="">--Select Status--</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            <span class="text-danger error-text status_error"></span>
                                        </div>
                                       



                                    </div>
                                  
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-dismiss="modal">Cancel</button>


                                    <input class="btn btn-success btn-sm"type="submit" value="Update">
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
       

       
        //create  warehouse

        $(document).on('submit', 'form#add_warehouse_form', function(e) {
            e.preventDefault();
            var name = $("#name").val();
            var product_id=$("#product_id").val();
            var current_stock=$("#current_stock").val();
            var minimum_stock=$("#minimum_stock").val();
            var maximum_stock=$("#maximum_stock").val();
            var transfer_id=$("#transfer_id").val();
            var fd = new FormData();
            fd.append('name',name);
            fd.append('product_id',product_id);
            fd.append('current_stock',current_stock);
            fd.append('minimum_stock',minimum_stock);
            fd.append('maximum_stock',maximum_stock);
            fd.append('transfer_id',transfer_id);
           



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'warehouse/create',
                method: "POST",
                contentType: false,
                processData: false,
                data:fd,

                dataType: "json",
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#warehouse-modal').modal('hide');
                        Swal.fire(
                            'Added',
                            'Warehouse Added Successfully!',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);


                    } else if (res.status === 400) {
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
        $(document).on('click', '#edit_warehouse', function(e) {
            e.preventDefault();

            let edit_id = $(this).attr('edit_id');
            $.ajax({
                url: 'warehouse/edit/' + edit_id,
                success: function(data) {
                    $('#editWarehouse-modal input[id="edit_id"]').val(data.id);
                    $('#editWarehouse-modal input[id="edit_name"]').val(data.name);
                    $('#editWarehouse-modal .product').html(data.product_id);
                    $('#editWarehouse-modal input[id="edit_current_stock"]').val(data.current_stock);
                    $('#editWarehouse-modal input[id="edit_minimum_stock"]').val(data.minimum_stock);
                    $('#editWarehouse-modal input[id="edit_maximum_stock"]').val(data.maximum_stock);
                    $('#editWarehouse-modal input[id="edit_transfer_id"]').val(data.transfer_id);


                    $('#editWarehouse-modal select[id="edit_status"]').val(data.status);


                    $('#editWarehouse-modal').modal('show');
                }
            })
        });

        //update single data
        $(document).on('submit', 'form#updateData', function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            var name = $("#edit_name").val();
            var product_id=$("#edit_product_id").val();
            var current_stock=$("#edit_current_stock").val();
            var minimum_stock=$("#edit_minimum_stock").val();
            var maximum_stock=$("#edit_maximum_stock").val();
            var transfer_id=$("#edit_transfer_id").val();
            var status=$("#edit_status").val();
            var fd = new FormData();
            fd.append('name',name);
            fd.append('product_id',product_id);
            fd.append('current_stock',current_stock);
            fd.append('minimum_stock',minimum_stock);
            fd.append('maximum_stock',maximum_stock);
            fd.append('transfer_id',transfer_id);
            fd.append('status',status);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'warehouse/update/' + id,
                type: "post",
                contentType: false,
                processData: false,
                data: fd,

                success: function(res) {
                    if (res.status == 200) {
                        $('#editWarehouse-modal').modal('hide');
                        Swal.fire(
                            'Update',
                            'Warehouse Update Successfully!',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else if (res.status === 400) {
                        $.each(res.errors, function(key, err_value) {
                            $('span.' + key + '_error').text(err_value[0]);
                        });
                    }
                }

            });
        });
        //temporary delet
        //warehouse  temporary delete
        $(document).on('click', 'a#delete_warehouse', function(e) {
            e.preventDefault();
            let id = $(this).attr('delete_id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'warehouse-temporary-delete/' + id,
                        success: function(data) {
                            Swal.fire(
                                'Delete',
                                'Warehouse Deleted Successfully!',
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
