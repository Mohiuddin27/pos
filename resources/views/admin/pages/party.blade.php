@extends('admin.layout.master')

@section('content')
    <style>
        .partyy .dropdown-menu {
            background-color: rgb(255, 255, 255);
            min-width: 100px !important;
            height: 100px !important;
            text-align: center!important;
            margin-top: 45px !important;
            margin-left: -10px !important;
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
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title" style="color:rgb(0, 157, 255); font-size:20px;">{{$type}} List</h4>
                                            <div></div>
                                            <div>
                                                @if(Auth::guard('admin')->user()->can('party.create'))
                                                <a href="#party-modal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add {{$type}}</a>
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


                                    </div>
                                    <div class="card-body" style="margin-top:-55px!important;">
                                        <table class="table table-data">
                                            <thead>
                                                <tr style="margin-top:20px!important">
                                                    <th style="width:5%">SL</th>
                                                    <th style="width:25%">Party Info</th>
                                                    <th style="width:25%">Address</th>
                                                    <th style="width:25%">Contact</th>
                                                    {{-- <th>Party Type</th> --}}
                                                    <th style="width:10%">Status</th>
                                                    <th class="text-center" style="width:10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parties as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><span class="fw-bold">Name:</span> {{ $data->name }}<br>
                                                            <span class="fw-bold">Cr.Limit:</span> {{$data->credit_limit}}<br>
                                                            <span class="fw-bold">Party Payment Method:</span> {{$data->party_variety}}
                                                        
                                                        </td>
                                                        <td> <span class="fw-bold">Address:</span> {{$data->address}}<br>
                                                            <span class="fw-bold">District:</span> {{$data->district}}<br>
                                                            <span class="fw-bold">Country:</span> {{$data->country}}
                                                        
                                                        </td>
                                                        <td> <span class="fw-bold">Phone:</span> {{$data->mobile_no}}<br>
                                                            <span class="fw-bold">ALT:</span> {{$data->alternative_mobile_no}}<br>
                                                            <span class="fw-bold">Email:</span> {{$data->email}}
                                                        
                                                        </td>
                                                        <td>
                                                            @if ($data->status == 'Active')
                                                                <span class="badge bg-success">{{ $data->status }}</span>
                                                            @else
                                                                <span class="badge bg-warning">{{ $data->status }}</span>
                                                            @endif

                                                        </td>

                                                        <td class="text-center">
                                                            <div class="dropdown partyy">
                                                                <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton1"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-cog" aria-hidden="true"></i>

                                                                </button>
                                                                <ul class="dropdown-menu col-md-4"
                                                                    aria-labelledby="dropdownMenuButton1">
                                                                    @if(Auth::guard('admin')->user()->can('party.view'))
                                                                    <li><a class="btn btn-light btn-sm dropdown-item"
                                                                            id="view_party" view_id="{{ $data->id }}"
                                                                            href=""><i class="fa fa-eye text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                View</i>
                                                                        </a> </li>
                                                                    @endif
                                                                    @if(Auth::guard('admin')->user()->can('party.edit'))
                                                                    <li> <a class="btn btn-warning btn-sm dropdown-item"
                                                                            edit_id="{{ $data->id }}"
                                                                            data-bs-toggle="modal" id="edit_party"><i
                                                                                class="fa fa-pencil-square-o  text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Edit</i>
                                                                        </a></li>
                                                                        @endif
                                                                        @if(Auth::guard('admin')->user()->can('party.temporary.delete'))
                                                                    <li> <a class="btn btn-light btn-sm dropdown-item"
                                                                            id="delete_party"
                                                                            delete_id="{{ $data->id }}"
                                                                            href=""><i
                                                                                class="fa fa-trash text-dark"
                                                                                style="font-size:20px" aria-hidden="true">
                                                                                Delete</i>
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
            {{-- add party --}}

            <div id="party-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center text-info">Add {{$type}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <form id="add_party_form" action="" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group" style="width:45%">
                                        <label for="" class="mb-2 mt-2">{{$type}} name</label>
                                        <input name="name" class="form-control" id="name" type="text"
                                            placeholder="Name">
                                        <span class="text-danger error-text name_error"></span>

                                        {{-- <div class="mess1 mt-1"></div> --}}
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Address</label>
                                        <textarea name="address" class="form-control" id="address"></textarea>
                                        <span class="text-danger error-text address_error"></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45 " style="width:45%">
                                        <label for="" class="mb-2 mt-2">Contact Person</label>
                                        <input name="contact_person" class="form-control" id="contact_person"
                                            type="text" placeholder="Name">
                                        <span class="text-danger error-text contact_person_error"></span>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Country</label>
                                        <input name="country" class="form-control" id="country" type="text"
                                            placeholder="Country">
                                        <span class="text-danger error-text country_error"></span>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Email</label>
                                        <input name="email" class="form-control" id="email" type="email"
                                            placeholder="Email">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">District</label>
                                        <input name="district" class="form-control" id="district" type="text"
                                            placeholder="District">
                                        <span class="text-danger error-text district_error"></span>
                                    </div>


                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Mobile Number</label>
                                        <input name="mobile_no" class="form-control" id="mobile_no" type="text"
                                            placeholder="Mobile Number">
                                        <span class="text-danger error-text mobile_no_error"></span>
                                    </div>
                                    <div class="form-group w-45" style="width:45%">
                                        <label for="" class="mb-2 mt-2">Credit Limit</label>
                                        <input name="credit_limit" class="form-control" id="credit_limit" type="number"
                                            placeholder="Credit Limit">
                                        <span class="text-danger error-text credit_limit_error"></span>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Alternative Mobile Number</label>
                                        <input name="alternative_mobile_no" class="form-control"
                                            id="alternative_mobile_no" type="text"
                                            placeholder="alternative_mobile_no">
                                        <span class="text-danger error-text alternative_mobile_no_error"></span>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">{{$type}} Type</label>

                                            <select id="party_variety" name="party_variety" class="form-control">
                                                <option value="">Choose party type</option>
                                                <option value="Cash"> Cash</option>
                                                <option value="Regular">Regular</option>
                                            </select>

                                        <span class="text-danger error-text party_variety_error"></span>

                                    </div>
                               


                                </div>
                             



                                <input type="hidden" name="party_type" id="party_type" value="{{$type}}" />
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="SAVE">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            {{-- //single party view --}}
            <div id="partysingle-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="text-transform:uppercase">Party Single View</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                               <div class="row">
                                <div class="col-md-6">


                                    <h4><strong>Party Name:</strong> <span id="name"></span></h4>

                                </div>
                                <div class="col-md-6">


                                    <h4><strong>Address:</strong> <span id="address"></span></h4>

                                </div>
                               </div>

                            </div>
                            <div class=" mb-2">
                              <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Contact Person:</strong> <span id="contact_person"></span></h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Country:</strong> <span id="country"></span></h4>
                                </div>
                              </div>

                            </div>
                            <div class="mb-2">
                               <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Email:</strong> <span id="email"></span></h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>District:</strong> <span id="district"></span></h4>
                                </div>
                               </div>

                            </div>
                            <div class="mb-2">
                               <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Mobile Number:</strong> <span id="mobile_no"></span></h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Credit Limit:</strong> <span id="credit_limit"></span></h4>
                                </div>
                               </div>

                            </div>
                            <div class="mb-2">
                              <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Alternative Mobile Number:</strong> <span id="alternative_mobile_no"></span></h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Current Due:</strong> <span id="current_due"></span></h4>
                                </div>
                              </div>

                            </div>
                            <div class="mb-2">
                              <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Party Type:</strong> <span id="partytype"></span>
                                    </h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Opening Due:</strong> <span id="opening_due"></span></h4>
                                </div>
                              </div>

                            </div>
                            <div class="mb-2">
                               <div class="row">
                                <div class="col-md-6">

                                    <h4><strong>Status:</strong> <span id="status"></span></h4>
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Created By:</strong> <span id="created_by"></span></h4>
                                </div>
                               </div>

                            </div>
                           



                            {{-- <form action="" method="POST">
                                @csrf

                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group" style="width:45%">

                                        <label for="">Party name</label>
                                        <input name="id" id="id" class="form-control" type="hidden"
                                            placeholder="title">
                                        <input name="name" class="form-control" id="name" type="text"
                                            placeholder="Name" readonly>
                                        <div class="mess1 mt-1"></div>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control" id="address" readonly></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45 " style="width:45%">
                                        <label for="">Contact Person</label>
                                        <input name="contact_person" class="form-control" id="contact_person"
                                            type="text" placeholder="Name" readonly>
                                        <div class="mess2 mt-1"></div>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Country</label>
                                        <input name="country" class="form-control" id="country" type="text"
                                            placeholder="Country" readonly>
                                        <div class="mess6 mt-1"></div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Email</label>
                                        <input name="email" class="form-control" id="email" type="email"
                                            placeholder="Email" readonly>
                                        <div class="mess3 mt-1"></div>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">District</label>
                                        <input name="district" class="form-control" id="district" type="text"
                                            placeholder="District" readonly>
                                        <div class="mess7 mt-1"></div>
                                    </div>


                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Mobile Number</label>
                                        <input name="mobile_no" class="form-control" id="mobile_no" type="text"
                                            placeholder="Mobile Number" readonly>
                                        <div class="mess4 mt-1"></div>
                                    </div>
                                    <div class="form-group w-45" style="width:45%">
                                        <label for="">Credit Limit</label>
                                        <input name="credit_limit" class="form-control" id="credit_limit" type="number"
                                            placeholder="Credit Limit" readonly>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Alternative Mobile Number</label>
                                        <input name="alternative_mobile_no" class="form-control"
                                            id="alternative_mobile_no" type="text" placeholder="alternative_mobile_no"
                                            readonly>
                                        <div class="mess5 mt-1"></div>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Current Due</label>
                                        <input name="current_due" class="form-control" id="current_due" type="number"
                                            placeholder="current_due" readonly>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Party Type</label>
                                        <div class="partytype"></div>


                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Opening Due</label>
                                        <input name="opening_due" class="form-control" id="opening_due" type="number"
                                            placeholder="opening_due" readonly>
                                        
                                    </div>


                                </div>


                                <div class="d-flex justify-content-between">
                                    <div class="form-group" style="width:45%">
                                        <label for="">Status</label>
                                        <input type="text" name="status" id="status"class="form-control"
                                            readonly>


                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Created By</label>
                                        <input name="created_by" class="form-control" id="created_by" type="text"
                                            readonly>
                                        
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Updated By</label>
                                        <input name="updated_by" class="form-control" id="updated_by" type="text"
                                            readonly>

                                    </div>

                                </div>



                            </form> --}}
                        </div>
                    </div>

                </div>

            </div>
            {{-- //edit party --}}
            <div id="editparty-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Party</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                           
                            <form action="" id="updateParty" method="POST">
                                {{-- @csrf
                                @method('PUT') --}}
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group" style="width:45%">
                                        <input name="id" id="edit_id" class="form-control" type="hidden"
                                        placeholder="title">
                                        <label for="" class="mt-2 mb-2">{{$type}} name</label>

                                        <input name="name" class="form-control" id="edit_name" type="text"
                                            placeholder="Name">
                                            <span class="text-danger error-text name_error"></span>
                                    </div>

                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Address</label>
                                        <textarea name="address" class="form-control" id="edit_address"></textarea>
                                        <span class="text-danger error-text address_error"></span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45 " style="width:45%">
                                        <label for="" class="mt-2 mb-2">Contact Person</label>
                                        <input name="contact_person" class="form-control" id="edit_contact_person"
                                            type="text" placeholder="Name">
                                        <span class="text-danger error-text contact_person_error"></span>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Country</label>
                                        <input name="country" class="form-control" id="edit_country" type="text"
                                            placeholder="Country">
                                        <span class="text-danger error-text country_error"></span>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Email</label>
                                        <input name="email" class="form-control" id="edit_email" type="email"
                                            placeh  older="Email">
                                      <span class="text-danger error-text email_error"></span>
                                    </div>
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">District</label>
                                        <input name="district" class="form-control" id="edit_district" type="text"
                                            placeholder="District">
                                            <span class="text-danger error-text district_error"></span>
                                        </div>


                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Mobile Number</label>
                                        <input name="mobile_no" class="form-control" id="edit_mobile_no" type="text"
                                            placeholder="Mobile Number">
                                            <span class="text-danger error-text moblie_no_error"></span>
                                        </div>

                                    <div class="form-group w-45" style="width:45%">
                                        <label for="" class="mb-2 mt-2">Credit Limit</label>
                                        <input name="credit_limit" class="form-control" id="edit_credit_limit" type="number"
                                            placeholder="Credit Limit">
                                            <span class="text-danger error-text credit_limit_error"></span>
                                        </div>



                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mb-2 mt-2">Alternative Mobile Number</label>
                                        <input name="alternative_mobile_no" class="form-control"
                                            id="edit_alternative_mobile_no" type="text" placeholder="alternative_mobile_no"
                                            >
                                        <span class="text-danger error-text alternative_mobile_no"></span>

                                    </div>
                                    <div class="form-group w-45" style="width:45%">
                                        <label for="" class="mb-2 mt-2">Status</label>
                                        <br>
                                        <select name="status" class="form-control" style="width:40%" id="edit_status">
                                            <option value="">--Select Status--</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>



                                        </select>
                                        <span class="text-danger error-text status_error"></span>

                                    </div>
                                    {{-- <div class="form-group w-45"style="width:45%">
                                        <label for="">Current Due</label>
                                        <input name="current_due" class="form-control" id="edit_current_due" type="number"
                                            placeholder="current_due">
                                            <span class="text-danger error-text current_due_error"></span>
                                        </div> --}}


                                </div>
                                {{-- <div class="d-flex justify-content-between mb-2">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Party Type</label>
                                        <div class="partytype"></div>
                                        <span class="text-danger error-text party_type_error"></span>



                                    </div>

                                    <div class="form-group w-45"style="width:45%">
                                        <label for="">Opening Due</label>
                                        <input name="opening_due" class="form-control" id="edit_opening_due" type="number"
                                            placeholder="opening_due">
                                            <span class="text-danger error-text opening_due_error"></span>

                                    </div>

                                </div> --}}
                                <div class="d-flex justify-content-between">
                                    <div class="form-group w-45"style="width:45%">
                                        <label for="" class="mt-2 mb-2">{{$type}} Type</label>

                                            <select id="edit_party_variety" name="party_variety" class="form-control">
                                                <option value="">Choose party type</option>
                                                <option value="Cash"> Cash</option>
                                                <option value="Regular">Regular</option>
                                            </select>

                                        <span class="text-danger error-text party_variety_error"></span>

                                    </div>
                                   
                                </div>


                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="UPDATE">
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
    //STORE PARTY DATA TO DATABASE
    //create party type

    $(document).on('submit', 'form#add_party_form', function(e) {
        e.preventDefault();
        var  name = $("#name").val();
        var  contact_person = $("#contact_person").val();
        var  email = $("#email").val();
        var  mobile_no = $("#mobile_no").val();
        var  alternative_mobile_no = $("#alternative_mobile_no").val();
        var  country = $("#country").val();
        var  district = $("#district").val();
        var  address = $("#address").val();
        var  credit_limit = $("#credit_limit").val();
        var  party_type = $("#party_type").val();
        var  party_variety = $("#party_variety").val();

        var fd = new FormData();
        fd.append('name',name);
        fd.append('contact_person',contact_person);
        fd.append('email',email);
        fd.append('mobile_no',mobile_no);
        fd.append('alternative_mobile_no',alternative_mobile_no);
        fd.append('country',country);
        fd.append('district',district);
        fd.append('address',address);
        fd.append('credit_limit',credit_limit);
        fd.append('party_type',party_type);
        fd.append('party_variety',party_variety);

        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/parties-create',
            method: "POST",
            contentType: false,
            processData: false,
            data: fd,
            dataType:"json",
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(res) {
                if (res.status == 200) {
                    $('#party-modal').modal('hide');

                    Swal.fire(
                        'Added',
                        'Party  Added Successfully!',
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

    //PARTY EDIT DATA SHOW
    $(document).on('click', '#edit_party', function(e) {
        e.preventDefault();

        var edit_id = $(this).attr('edit_id');

        $.ajax({
            url: '/parties-edit/' + edit_id,
            success: function(data) {
                $('#editparty-modal input[id="edit_id"]').val(data.id);
                $('#editparty-modal input[id="edit_name"]').val(data.name);
                $('#editparty-modal input[id="edit_contact_person"]').val(data.contact_person);
                $('#editparty-modal input[id="edit_email"]').val(data.email);
                $('#editparty-modal input[id="edit_mobile_no"]').val(data.mobile_no);
                $('#editparty-modal input[id="edit_alternative_mobile_no"]').val(data
                    .alternative_mobile_no);
                $('#editparty-modal textarea').text(data.address);
                $('#editparty-modal input[id="edit_district"]').val(data.district);
                $('#editparty-modal input[id="edit_country"]').val(data.country);
                $('#editparty-modal input[id="edit_credit_limit"]').val(data.credit_limit);
                // $('#editparty-modal input[id="edit_current_due"]').val(data.current_due);
                // $('#editparty-modal input[id="edit_opening_due"]').val(data.opening_due);
                $('#editparty-modal select[id="edit_status"]').val(data.status);
                $('#editparty-modal select[id="edit_party_variety"]').val(data.party_variety);

                // $('#editparty-modal .partytype').html(data.party);


                $('#editparty-modal').modal('show');
            }
        })
    });
    //DATATABLE
    $(document).ready(function() {
        $('table.table-data').DataTable();
        // $('#partytype').select2();

    });
    //PARTY SINGLE VIEW
    $(document).on('click', '#view_party', function(e) {
        e.preventDefault();

        let view_id = $(this).attr('view_id');
        $.ajax({
            url: '/parties-singleview/'+ view_id,
            success: function(data) {
                $('#partysingle-modal input[name="id"]').val(data.id);
                $('#partysingle-modal span[id="name"]').text(data.name);
                $('#partysingle-modal span[id="contact_person"]').text(data.contact_person);
                $('#partysingle-modal span[id="email"]').text(data.email);
                $('#partysingle-modal span[id="mobile_no"]').text(data.mobile_no);
                $('#partysingle-modal span[id="alternative_mobile_no"]').text(data
                    .alternative_mobile_no);
                $('#partysingle-modal span[id="address"]').text(data.address);
                $('#partysingle-modal span[id="district"]').text(data.district);
                $('#partysingle-modal span[id="country"]').text(data.country);
                $('#partysingle-modal span[id="credit_limit"]').text(data.credit_limit);
                $('#partysingle-modal span[id="current_due"]').text(data.current_due);
                $('#partysingle-modal span[id="opening_due"]').text(data.opening_due);
                $('#partysingle-modal span[id="partytype"]').html(data.party);
                $('#partysingle-modal span[id="status"]').text(data.status);
                $('#partysingle-modal span[id="created_by"]').text(data.created_by);
                $('#partysingle-modal span[id="updated_by"]').text(data.updated_by);
                $('#partysingle-modal span[id="restored_by"]').text(data.restored_by);



                $('#partysingle-modal').modal('show');
                // alert(data);
            }
        })
    });

 //Party single data update
 $(document).on('submit', 'form#updateParty', function(e) {
        e.preventDefault();
        var id = $('#edit_id').val();
        var  name = $("#edit_name").val();
        var  contact_person = $("#edit_contact_person").val();
        var  email = $("#edit_email").val();
        var  mobile_no = $("#edit_mobile_no").val();
        var  alternative_mobile_no = $("#edit_alternative_mobile_no").val();
        var  country = $("#edit_country").val();
        var  district = $("#edit_district").val();
        var  address = $("#edit_address").val();
        var  credit_limit = $("#edit_credit_limit").val();
        // var current_due=$("#edit_current_due").val();
        // var opening_due=$("#edit_opening_due").val();
        var  party_variety = $("#edit_party_variety").val();
        var status=$("#edit_status").val();
        var fd = new FormData();
        fd.append('name',name);
        fd.append('contact_person',contact_person);
        fd.append('email',email);
        fd.append('mobile_no',mobile_no);
        fd.append('alternative_mobile_no',alternative_mobile_no);
        fd.append('country',country);
        fd.append('district',district);
        fd.append('address',address);
        fd.append('credit_limit',credit_limit);
        // fd.append('current_due',current_due);
        // fd.append('opening_due',opening_due);
        fd.append('party_variety',party_variety);
        fd.append('status',status);
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/parties-update/'+id,
            method: "post",
            contentType: false,
            processData: false,
            data: fd,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(res) {
                if (res.status == 200) {
                    $('#editparty-modal').modal('hide');

                    Swal.fire(
                        'Update',
                        'Party  Updated Successfully!',
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
                // alert(res.name);

            }
        });
       
    });

    //party temporarly delete

    $(document).on('click', 'a#delete_party', function(e) {
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
                    url: '/parties-temporary-delete/' + id,
                    success: function(data) {
                        Swal.fire(
                            'Delete',
                            'Party Temporarily Deleted Successfully!',
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
