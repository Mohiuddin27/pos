@extends('admin.layout.master')
@section('content')
<main class="content">
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
                                                    <h4 class="card-title">Inactive Party </h4>
                                                    <div></div>
                                                  
                                                </div>
                                                <div>
                                                    <a href="{{route('party.index')}}" style="cursor:pointer" class="badge bg-success">Active</a>
                                                    <a href="{{route('party.trash')}}" style="cursor:pointer" class="badge bg-danger">Trash</a>
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
                                                            <th>Party Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      @foreach($party as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->email}}</td>
                                                            <td>{{$data->mobile_no}}</td>
                                                            <td>{{$data->partytype->type_name}}</td>
                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td>
                                                                <a class="btn btn-primary" href="{{route('party.reactive',$data->id)}}">Reactive
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
@endsection