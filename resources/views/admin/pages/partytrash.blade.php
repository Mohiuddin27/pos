@extends('admin.layout.master')
@section('content')
<main class="content">
    <style>
          .partyy .dropdown-menu {
            background-color: rgb(255, 255, 255);
           
            margin-top: 45px !important;
            margin-left: -18px !important;
        }
        .dataTables_length label{
            margin-bottom:50px;
        }
      </style>
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Party</h1>

                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Party Trash</h4>
                                                    <div></div>
                                                    {{-- <div>
                                                        <a href="#partytype-modal"  data-bs-toggle="modal" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Category</a>
                                                    </div> --}}
                                                </div>
                                                <div>
                                                    <a href="{{route('party.index')}}" style="cursor:pointer" class="badge bg-success">All Party List</a>
                                                    {{-- <a href="{{route('party.inactive')}}" class="badge bg-warning">Inactive</a> --}}
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
                                                            <th>Party Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile Number</th>
                                                        
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($party as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->email}}</td>
                                                            <td>{{$data->mobile_no}}</td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="restore_data" restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="permanently_delete" delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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
                    
                       
                        

                    

                </div>
            </main>  
            <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
           </script>
<script>
//DATATABLE
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
                            url: 'party-restore/' + id,
                            success: function(data) {
                                Swal.fire(
                                    'Success',
                                    'Party Type  Restore Successfully!',
                                    'success'
                                )
                               
                                setTimeout(function() {
                                    window.location.href="party";
                                }, 2000);
    
    
                            }
                        });
                    }
                })
            });
 // party permanently delete
$(document).on('click','a#permanently_delete',function(e){
  e.preventDefault();
  let id=$(this).attr('delete_id');
  
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if(result.isConfirmed) {
      $.ajax({
        url : 'party-permanently-delete/' + id,
        success:function(data){
          Swal.fire(
            'Delete',
            'Party  Deleted Successfully!',
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