@extends('admin.layout.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Welcome <strong style="text-transform:capitalize">{{Auth::guard('admin')->user()->name}}</strong></h1>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card bg-info text-light">
                            <div class="seo-fact sbg2 text-light">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon fs-3"><i class="fa fa-user"></i> Admins</div>
                                        <h2 class="text-light">{{ $total_admins }}</h2>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5 mb-3">
                        <div class="card bg-success text-light">
                            <div class="seo-fact sbg1 text-light">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon fs-3"><i class="fa fa-users"></i> Roles</div>
                                        <h2 class="text-light">{{ $total_roles }}</h2>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                   

                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card" style="background-color: rgb(0, 153, 255)">
                            <div class="seo-fact sbg3 text-light">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon fs-3"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                         Permissions</div>
                                    <h2 class="text-light">{{ $total_permissions }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card" style="background-color:rgb(165, 74, 255)">
                            <div class="seo-fact sbg3 text-light">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon fs-3"><i class="fa fa-users" aria-hidden="true"></i>
                                         Party</div>
                                    <h2 class="text-light">{{ $total_parties }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card" style="background-color:rgb(252, 41, 111)">
                            <div class="seo-fact sbg3 text-light">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon fs-3"><i class="fa fa-users" aria-hidden="true"></i>
                                         Party Types</div>
                                    <h2 class="text-light">{{ $total_party_types }}</h2>
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