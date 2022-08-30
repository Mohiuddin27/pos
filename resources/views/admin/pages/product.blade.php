@extends('admin.layout.master')
@section('content')
    <style>
        .partyy .dropdown-menu {
            min-width: 80px !important;
            margin-top: 40px !important;
            margin-left: -20px !important;
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

            <h1 class="h3 mb-3"><strong>Product</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">All Product</h4>
                                            <div></div>
                                            <div>
                                                {{-- @if (Auth::guard('admin')->user()->can('party.type.create')) --}}
                                                <a href="#product-modal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Product</a>
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
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Category</th>
                                                    <th>Product Brand</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            @if (!empty($data->image))
                                                                <img style="width:60px;height:60px;"src="{{ URL::to('/') }}/media/products/{{ $data->image }}"
                                                                    alt="">
                                                            @endif
                                                        </td>

                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->productCategory->name }}</td>
                                                        <td>{{ $data->productBrand->name }}</td>

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
                                                                            data-bs-toggle="modal" id="edit_product"><i
                                                                                class="fa fa-pencil-square-o  text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Edit</i>
                                                                        </a></li>
                                                                    <li> <a class="btn btn-light btn-sm dropdown-item text-center"
                                                                            id="delete_product"
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

            <div id="product-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                        </div>

                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_product_form" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                      
                                        <div class="form-group">
                                            <label for="" class="mb-2">Category</label>

                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($productCategories as $category)
                                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text category_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Model No</label>
                                            <input name="model_no" class="form-control" id="model_no" type="text"
                                                placeholder="Model Number">
                                            <span class="text-danger error-text model_no_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Opening Stock</label>
                                            <input name="opening_stock" class="form-control" id="opening_stock"
                                                type="number" placeholder="opening stock">
                                            <span class="text-danger error-text opening_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Type</label>
                                            <select name="type" class="form-control" id="type">
                                                <option value="">Select Type</option>
                                                <option value="regular">regular</option>
                                                <option value="serialize">serliaze</option>
                                                <option value="service">service</option>

                                            </select>
                                            <span class="text-danger error-text type_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:70px;cursor: pointer;" for="image"><i
                                                    class="fa fa-file-image-o mb-2"></i></label>
                                            <input type="file" name="image" id="image" style="display:none">
                                            <img style="max-width:50%;display:block"id="product_image_load"
                                                src="" alt="">
                                            <span class="text-danger error-text image_error"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Brand</label>

                                            <select name="brand_id" class="form-control" id="brand_id">
                                                <option value="">Select Brand</option>
                                                @foreach ($productBrands as $brand)
                                                    <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text brand_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Unit</label>

                                            <select name="unit_id" class="form-control" id="unit_id">
                                                <option value="">Select Unit</option>
                                                @foreach ($productUnits as $unit)
                                                    <option value="{{ $unit->id }}"> {{ $unit->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger error-text unit_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Purchase Price</label>
                                            <input name="purchase_price" class="form-control" id="purchase_price"
                                                type="number" placeholder="purchase price">
                                            <span class="text-danger error-text purchase_price_error"></span>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Reminder Stock</label>
                                            <input name="remainder_quantity" class="form-control" id="remainder_quantity"
                                                type="number" placeholder="Remainder Stock">
                                            <span class="text-danger error-text remainder_quantity_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Stock Check</label>
                                            <select name="stock_check" class="form-control" id="stock_check">
                                                <option value="">Select Stock Check</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>

                                            </select>
                                            <span class="text-danger error-text stock_check_error"></span>
                                        </div>
                                      


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Product name</label>
                                            <input name="name" class="form-control" id="name" type="text"
                                                placeholder="Name">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                     
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Current Stock</label>
                                            <input name="current_stock" class="form-control" id="current_stock"
                                                type="number" placeholder="current stock">
                                            <span class="text-danger error-text current_stock_error"></span>
                                        </div>

                                    
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Sale Price</label>
                                            <input name="sale_price" class="form-control" id="sale_price" type="number"
                                                placeholder="sale price">
                                            <span class="text-danger error-text sale_price_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Items In Box</label>
                                            <input name="items_in_box" class="form-control" id="items_in_box"
                                                type="number" placeholder="items in box">
                                            <span class="text-danger error-text items_in_box_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Notes</label>
                                           
                                            <textarea id="notes" name="notes" class="form-control"></textarea>
                                            <span class="text-danger error-text notes_error"></span>
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
            <div id="editProduct-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Product Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <form id="updateData" action="" method="POST" enctype="multipart/form-data">
                                {{-- @csrf
                                @method('PUT') --}}

                                <div class="row">
                                    <div class="col-md-4">
                                      
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            
                                            <input name="id" id="edit_id" class="form-control" type="hidden"
                                                placeholder="title">
                                            <div class="category"></div>
                                            <span class="text-danger error-text category_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Model No</label>
                                            <input name="model_no" class="form-control" id="edit_model_no" type="text"
                                                placeholder="Model Number">
                                            <span class="text-danger error-text model_no_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Opening Stock</label>
                                            <input name="opening_stock" class="form-control" id="edit_opening_stock"
                                                type="number" placeholder="opening stock">
                                            <span class="text-danger error-text opening_stock_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Type</label>
                                            <select name="type" class="form-control" id="edit_type">
                                                <option value="">Select Type</option>
                                                <option value="regular">regular</option>
                                                <option value="serialize">serliaze</option>
                                                <option value="service">service</option>

                                            </select>
                                            <span class="text-danger error-text type_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:70px;cursor: pointer;" for="imageedit"><i
                                                    class="fa fa-file-image-o"></i></label>
                                            <input type="file" name="image"id="imageedit" style="display:none">
                                            <img style="max-width:50%;display:block"id="product_image_edit"
                                                src="" alt="">

                                            <span class="text-danger error-text image_error"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Brand</label>
                                            <div class="brand"></div>
                                           
                                            <span class="text-danger error-text brand_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Unit</label>
                                            <div class="unit"></div>
                                            <span class="text-danger error-text unit_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Purchase Price</label>
                                            <input name="purchase_price" class="form-control" id="edit_purchase_price"
                                                type="number" placeholder="purchase price">
                                            <span class="text-danger error-text purchase_price_error"></span>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Reminder Stock</label>
                                            <input name="remainder_quantity" class="form-control" id="edit_remainder_quantity"
                                                type="number" placeholder="Remainder Stock">
                                            <span class="text-danger error-text remainder_quantity_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Stock Check</label>
                                            <select name="stock_check" class="form-control" id="edit_stock_check">
                                                <option value="">Select Stock Check</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>

                                            </select>
                                            <span class="text-danger error-text stock_check_error"></span>
                                        </div>
                                      


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Product name</label>
                                            <input name="name" class="form-control" id="edit_name" type="text"
                                                placeholder="Name">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                     
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Current Stock</label>
                                            <input name="current_stock" class="form-control" id="edit_current_stock"
                                                type="number" placeholder="current stock">
                                            <span class="text-danger error-text current_stock_error"></span>
                                        </div>

                                    
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Sale Price</label>
                                            <input name="sale_price" class="form-control" id="edit_sale_price" type="number"
                                                placeholder="sale price">
                                            <span class="text-danger error-text sale_price_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Items In Box</label>
                                            <input name="items_in_box" class="form-control" id="edit_items_in_box"
                                                type="number" placeholder="items in box">
                                            <span class="text-danger error-text items_in_box_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Notes</label>
                                           
                                            <textarea id="edit_notes" name="notes" class="form-control"></textarea>
                                            <span class="text-danger error-text notes_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-2 mt-2">Status</label>
                                            <br>
                                            <select name="status" class="form-control" style="width:40%" id="edit_status"
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
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Cancel</button>


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

        //product image load
        $(document).on('change', "input#image", function(e) {
            e.preventDefault();
            let product_image_url = URL.createObjectURL(e.target.files[0]);
            $('img#product_image_load').attr('src', product_image_url);
        });

        //post edit featured image load
        //post featured image load
        $(document).on('change', "input#imageedit", function(e) {
            e.preventDefault();
            let product_image_url = URL.createObjectURL(e.target.files[0]);
            $('img#product_image_edit').attr('src', product_image_url);
        });
        //create  product

        $(document).on('submit', 'form#add_product_form', function(e) {
            e.preventDefault();
            



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'product/create',
                method: "POST",
                contentType: false,
                processData: false,
                data: new FormData(this),
                // data:fd,

                dataType: "json",
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#product-modal').modal('hide');
                        Swal.fire(
                            'Added',
                            'Product  Added Successfully!',
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
        $(document).on('click', '#edit_product', function(e) {
            e.preventDefault();

            let edit_id = $(this).attr('edit_id');
            $.ajax({
                url: 'product/edit/' + edit_id,
                success: function(data) {
                    $('#editProduct-modal input[id="edit_id"]').val(data.id);
                    $('#editProduct-modal input[id="edit_name"]').val(data.name);
                    $('#editProduct-modal .category').html(data.category_id);
                    $('#editProduct-modal .brand').html(data.brand_id);
                    $('#editProduct-modal .unit').html(data.unit_id);
                    $('#editProduct-modal input[id="edit_model_no"]').val(data.model_no);
                    $('#editProduct-modal select[id="edit_type"]').val(data.type);
                    $('#editProduct-modal input[id="edit_remainder_quantity"]').val(data.remainder_quantity);
                    $('#editProduct-modal select[id="edit_stock_check"]').val(data.stock_check);
                    $('#product_image_edit').attr('src','media/products/'+ data.image);
                    $('#editProduct-modal input[id="edit_items_in_box"]').val(data.items_in_box);
                    $('#editProduct-modal input[id="edit_opening_stock"]').val(data.opening_stock);
                    $('#editProduct-modal input[id="edit_current_stock"]').val(data.current_stock);
                    $('#editProduct-modal input[id="edit_purchase_price"]').val(data.purchase_price);
                    $('#editProduct-modal input[id="edit_sale_price"]').val(data.sale_price);
                    $('#editProduct-modal textarea').text(data.notes);



                    $('#editProduct-modal select[id="edit_status"]').val(data.status);


                    $('#editProduct-modal').modal('show');
                }
            })
        });

        //update single data
        $(document).on('submit', 'form#updateData', function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            // var edit_name = $("#edit_name").val();
            // var edit_status = $('#edit_status').val();

            // var fd = new FormData();
            // // fd.append('id',id);
            // fd.append('name', edit_name);
            // fd.append('status', edit_status);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'product/update/' + id,
                type: "post",
                contentType: false,
                processData: false,
                data: new FormData(this),

                success: function(res) {
                    if (res.status == 200) {
                        $('#editProduct-modal').modal('hide');
                        Swal.fire(
                            'Update',
                            'Product Update Successfully!',
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
        //product category temporary delete
        $(document).on('click', 'a#delete_product', function(e) {
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
                        url: 'product-temporary-delete/' + id,
                        success: function(data) {
                            Swal.fire(
                                'Delete',
                                'Product Deleted Successfully!',
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
