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
                                                    <h4 class="card-title">Party Type Trash</h4>
                                                    <div></div>
                                                    {{-- <div>
                                                        <a href="#partytype-modal"  data-bs-toggle="modal" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Category</a>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    <a href="{{route('partytype.index')}}" style="cursor:pointer" class="badge bg-success">All Type Party List</a>
                                                   
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
                                                                
                                                              @if($data->status == 'Active')
                                                                <span class="badge bg-success">{{$data->status}}</span>
                                                              
                                                              @else
                                                              <span class="badge bg-warning">{{$data->status}}</span>
                                                              @endif
                                                             
                                                            </td>
                                                        
                                                            <td>
                                                                <a class="btn btn-info btn-sm text-light" id="restore_data" restore_id={{$data->id}}>Restore
                                                                </a>
                                                                <a class="btn btn-danger btn-sm" id="permanently_delete" delete_id="{{$data->id}}">Permanently Delete
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
                    
                       
                        

                    

                </div>
            </main>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
           
    
            //data table
    
            $(document).ready(function() {
                $('table.table-data').DataTable();
                // $('#partytype').select2();
    
            });
            //party type restore data
            $(document).on('click', 'a#restore_data', function(e) {
                e.preventDefault();
                let id = $(this).attr('restore_id');
    
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are going  to restore this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'partytype-restore/' + id,
                            success: function(data) {
                                Swal.fire(
                                    'Success',
                                    'Party Type  Restore Successfully!',
                                    'success'
                                )
                               
                                setTimeout(function() {
                                    window.location.href="party-type";
                                }, 2000);
    
    
                            }
                        });
                    }
                })
            });
          
            //party type permanently delete
            $(document).on('click', 'a#permanently_delete', function(e) {
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
                            url: 'partytype-permanently-delete/' + id,
                            success: function(data) {
                                Swal.fire(
                                    'Delete',
                                    'Party Type  Deleted Successfully!',
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