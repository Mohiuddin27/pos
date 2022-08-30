@if(Session::has('success'))
<p class="alert alert-success d-flex justify-content-between">{{Session::get('success')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger d-flex justify-content-between" role="alert">{{Session::get('error')}}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></p>
@endif