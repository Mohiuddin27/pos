@extends('admin.layout.master')
@section('content')
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
                                                    <h4 class="card-title">Inactive Party Type</h4>
                                                    <div></div>
                                                    {{-- <div>
                                                        <a href="#partytype-modal"  data-bs-toggle="modal" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Category</a>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    <a href="{{route('partytype.index')}}" style="cursor:pointer" class="badge bg-warning">Active</a>
                                                    <a href="{{route('partytype.trash')}}" style="cursor:pointer" class="badge bg-danger">Trash</a>
                                                </div><br>
                                                <div class="messs"></div>
                                                  @if(Session::has('success'))
                                                  <p class="alert alert-success d-flex justify-content-between">{{Session::get('success')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
                                           
                                          @endif
                                                {{-- @include('sweetalert::alert') --}}
                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Category Name</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                      @foreach($partytype as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->type_name}}</td>
                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td>
                                                                <a class="btn btn-primary" href="{{route('parttype.reactive',$data->id)}}">Reactive
                                                                </a>
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

                    {{-- <div id="partytype-modal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add new Partytype</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="mess"></div>

                                </div>
                                <div class="modal-body">
                                    <form id="add_party_type_form" action="" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Type name</label>
                                            <input name="type_name" class="form-control" id="type_name" type="text" placeholder="Name">
                                        </div>
                                        <div class="form-group mt-2 text-center">
                                            <input class="btn btn-success btn-block "type="submit" value="Add New">
                                        </div>
                                    </form>
                                </div>
                            </div>
        
                        </div>
        
                    </div> --}}


                    {{-- //edit party type --}}
                    {{-- <div id="editpartytype-modal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Partytype</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="mess"></div>

                                </div>
                                <div class="modal-body">
                                    <form id="" action="{{route('partytype.update')}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Type name</label>
                                            <input name="id" id="id" class="form-control" type="hidden" placeholder="title">
                                            <input name="type_name" class="form-control" id="type_name" type="text" placeholder="Name">
                                        </div><br>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <br>
                                             <select name="status" class="form-control" style="width:40%" id="status" required>
                                                 <option value="">--Select Status--</option>
                                                 <option  value="Active">Active</option>
                                                 <option value="Inactive">Inactive</option>
                               
                                
                               
                                             </select>


                                        </div>
                                        
                                        <div class="form-group mt-2 text-center">
                                            <input class="btn btn-success btn-block "type="submit" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
        
                        </div>
        
                    </div> --}}
                       
                        

                    

                </div>
            </main>  
@endsection