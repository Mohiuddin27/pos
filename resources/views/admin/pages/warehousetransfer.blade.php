@extends('admin.layout.master')
@section('content')
    <style>
        .partyy .dropdown-menu {
            min-width: 80px !important;
            margin-top: 40px !important;
            margin-left: 5px !important;
        }

        .dataTables_length label {
            margin-bottom: 20px;
        }
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse; 
        }
        thead{
            background-color:rgba(128, 128, 128, 0.144);
        }

    </style>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Warehouse Transfer</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Warehouse Transfer List</h4>
                                            <div></div>
                                            <div>
                                                {{-- @if (Auth::guard('admin')->user()->can('party.type.create')) --}}
                                                <a href="#warehousetransfer-modal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Warehouse Transfer</a>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="messs"></div>
                                        {{-- @if (Session::has('success'))
                                            <p class="alert alert-success d-flex justify-content-between">
                                                {{ Session::get('success') }}<button type="button" class="btn-close"
                                                    data-bs-dismiss="alert" aria-label="Close"></button></p>
                                        @endif --}}
                                        {{-- @include('sweetalert::alert') --}}

                                    </div>
                                    <div class="card-body" style="margin-top:-30px!important;">
                                        <table class="table table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Info<br>
                                                        
                                                    </th>
                                                    <th>Current Warehouse</th>
                                                    <th>Transfer Warehouse</th>
                                                    <th>Transfer Quantity</th>
                                                    {{-- <th class="text-center">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($warehousetransfer as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>Product_name: {{ $data->product->name }}<br>
                                                            Date: {{ $data->transferDate }}
                                                        </td>
                                                        <td>{{ $data->CurrentWarehouse->name }}</td>
                                                        <td>{{ $data->transferWarehouse->name }}</td>
                                                        <th>{{$data->transfer_stock}}</th>



                                                        {{-- <td>

                                                            @if ($data->status == 'Active')
                                                                <span class="badge bg-success">{{ $data->status }}</span>
                                                            @else
                                                                <span class="badge bg-warning">{{ $data->status }}</span>
                                                            @endif


                                                        </td> --}}

                                                        {{-- <td>
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
                                                                            data-bs-toggle="modal" id="edit_warehousetransfer"><i
                                                                                class="fa fa-pencil-square-o  text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Edit</i>
                                                                        </a></li>
                                                                    <li> <a class="btn btn-light btn-sm dropdown-item text-center"
                                                                            id="delete_warehousetransfer"
                                                                            delete_id="{{ $data->id }}"
                                                                            href=""><i class="fa fa-trash text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Delete</i>
                                                                        </a></li>
                                                                </ul>
                                                            </div>

                                                        </td> --}}
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

            <div id="warehousetransfer-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Warehouse Transfer</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                        </div>

                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_warehousetransfer_form" action="" method="POST">
                                @csrf
                                <div class="row border border-dark p-3 mb-3">
                                    <h3>Warehouse From</h3>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Transfer Date</label>
                                            <input name="transferDate" class="form-control" id="transferDate" type="date">
                                            <span class="text-danger error-text transferDate_error"></span>
                                        </div>
                                        
                                        <div class="form-group mt-2">
                                            <label for="" class="mb-2">Current Warehouse</label>

                                            <select name="current_warehouse_id" class="form-control" id="current_warehouse_id">
                                                <option value="">Select Warehouse</option>
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}"> {{ $warehouse->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text current_warehouse_id_error"></span>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Select Product</label>

                                            <select name="product_id" class="form-control product" id="product_id">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"> {{ $product->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text product_id_error"></span>
                                        </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="" class="mb-2">Current Stock</label>
                                                <input name="current_stock" class="form-control current_stockk" id="current_stock"
                                                    type="number" placeholder="current stock" readonly>
                                                <span class="text-danger error-text current_stock_error"></span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="" class="mb-2">Remaining Stock</label>
                                                <input name="remaining_stock" class="form-control remaining_stockk" id="remaining_stock"
                                                    type="number" placeholder="remaining stock" readonly>
                                                <span class="text-danger error-text remaining_stock_error"></span>
                                            </div>
                                        </div>
                                      </div>
                                      </div>


                                </div>
                                  
                                <div class="row border border-dark p-3">
                                    <h3>Warehouse To</h3>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Transfer Warehouse</label>
                                            <div class="transfer-warehouse"></div>
                                            <select name="transfer_warehouse_id" class="form-control"  id="transfer_warehouse">
                                                <option value="">Select Warehouse</option>
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}"> {{ $warehouse->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text transfer_warehouse_id_error"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Transfer Quantity</label>
                                            <input name="transfer_stock" class="form-control transfer_quantity" id="transfer_stock"
                                                type="number" placeholder="transfer stock">
                                            <span class="text-danger error-text transfer_stock_error"></span>
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
            <div id="editWarehouseTransfer-modal" class="modal fade">
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
                               
                                <div class="row border border-dark p-3 mb-3">
                                    <h3>Warehouse From</h3>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="id" id="edit_id" class="form-control" type="hidden"
                                            placeholder="title">
                                            <label for="" class="mb-2">Transfer Date</label>
                                            <input name="transferDate" class="form-control" id="transferDate" type="date"
                                                placeholder="Name">
                                            <span class="text-danger error-text transferDate_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product</label>

                                           <div class="product"></div>
                                            <span class="text-danger error-text product_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Current Warehouse</label>

                                             <div class="current_warehouse"></div>
                                            <span class="text-danger error-text current_warehouse_id_error"></span>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Current Stock</label>
                                            <input name="current_stock" class="form-control current_stockk" id="current_stock"
                                                type="number" placeholder="current stock" readonly>
                                            <span class="text-danger error-text current_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2">Remaining Stock</label>
                                            <input name="remaining_stock" class="form-control remaining_stockk" id="remaining_stock"
                                                type="number" placeholder="remaining stock" readonly>
                                            <span class="text-danger error-text remaining_stock_error"></span>
                                        </div>
                                      </div>


                                </div>
                                  
                                <div class="row border border-dark p-3">
                                    <h3>Warehouse To</h3>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Transfer Warehouse</label>

                                            <div class="transer_warehouse"></div>

                                            <span class="text-danger error-text transfer_warehouse_id_error"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Transfer Quantity</label>
                                            <input name="transfer_stock" class="form-control transfer_quantity" id="transfer_stock"
                                                type="number" placeholder="transfer stock">
                                            <span class="text-danger error-text transfer_stock_error"></span>
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
       var date = new Date();
      var year = date.getFullYear();
      var month = String(date.getMonth()+1).padStart(2,'0');
      var todayDate = String(date.getDate()).padStart(2,'0');
      var datePattern = year + '-' + month + '-' + todayDate;
      document.getElementById("transferDate").value = datePattern;

        //proudct change
        $(document).on('change','.product',function () {
		    var prod_id=$(this).val();

            

			// var a=$(this).parent();
			// console.log(prod_id);
			// var op="";
			$.ajax({
				type:'get',
				url:'findcurrentstock',
				data:{'id':prod_id},
				dataType:'json',//return data will be json
				success:function(data){
                    $('#warehousetransfer-modal input[id="current_stock"]').val(data.current_stock);
                    // $('#warehousetransfer-modal select[id="transfer_warehouse_id"]').style.display="none";

				},
				error:function(){

				}
			});


		});
      
        $(document).on('change','#current_warehouse_id',function () {
		    var current_id=$(this).val();
            document.getElementById('transfer_warehouse').style.display='none';

            

			// var a=$(this).parent();
			// console.log(prod_id);
			// var op="";
			$.ajax({
				type:'get',
				url:'currentwarehouse',
				data:{'id':current_id},
				dataType:'json',//return data will be json
				success:function(data){
                   $('#warehousetransfer-modal .transfer-warehouse').html(data.transfer);
                // alert(data.transfer);
                    // $('#warehousetransfer-modal select[id="transfer_warehouse_id"]').style.display="none";

				},
				error:function(){

				}
			});


		});

        document.getElementById('transfer_stock').addEventListener("change",function(){
           var transfer=document.getElementById('transfer_stock').value;
           var transfer_quantity=parseInt(transfer);
           const current=document.getElementById('current_stock').value;
           const current_stock=parseInt(current);
           document.getElementById('remaining_stock').value=current_stock-transfer_quantity;
        });


       
        //create  warehouse

        $(document).on('submit', 'form#add_warehousetransfer_form', function(e) {
            e.preventDefault();
            var transferDate = $("#transferDate").val();
            var current_warehouse_id=$("#current_warehouse_id").val();
            var product_id=$("#product_id").val();
            var current_stock=$("#current_stock").val();
            var remaining_stock=$("#remaining_stock").val();
            var transfer_warehouse_id=$("#transfer_warehouse_id").val();
            var transfer_stock=$('#transfer_stock').val();
            var fd = new FormData();
            fd.append('transferDate',transferDate);
            fd.append('current_warehouse_id',current_warehouse_id);
            fd.append('product_id',product_id);
            fd.append('current_stock',current_stock);
            fd.append('remaining_stock',remaining_stock);
            fd.append('transfer_warehouse_id',transfer_warehouse_id);
            fd.append('transfer_stock',transfer_stock);

           



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'warehouse-transfer/create',
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
                        $('#warehousetransfer-modal').modal('hide');
                        Swal.fire(
                            'Added',
                            'Warehouse Transfer Added Successfully!',
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
        $(document).on('click', '#edit_warehousetransfer', function(e) {
            e.preventDefault();

            let edit_id = $(this).attr('edit_id');
            $.ajax({
                url: 'warehouse-transfer/edit/' + edit_id,
                success: function(data) {
                    $('#editWarehouseTransfer-modal input[id="edit_id"]').val(data.id);
                    $('#editWarehouseTransfer-modal input[id="transferDate"]').val(data.transferDate);
                    $('#editWarehouseTransfer-modal .product').html(data.product_id);
                    $('#editWarehouseTransfer-modal .current_warehouse').html(data.current_warehouse_id);

                    $('#editWarehouseTransfer-modal input[id="current_stock"]').val(data.current_stock);
                    $('#editWarehouseTransfer-modal input[id="remaining_stock"]').val(data.remaining_stock);
                    $('#editWarehouseTransfer-modal .transfer_warehouse').val(data.transfer_warehouse_id);
                    $('#editWarehouseTransfer-modal input[id="transfer_stock"]').val(data.transfer_stock);


                    // $('#editWarehouse-modal select[id="edit_status"]').val(data.status);


                    $('#editWarehouseTransfer-modal').modal('show');
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
