<style>
    .dropdown{
        background-color:transparent!important;
    }
    .dropdown-menu {
            margin-top: 40px !important;
            
            
        }
        .sidebar-menu > ul > li {
    margin-bottom: 3px;
    position: relative;
    list-style: none;
}
.sidebar-menu ul{
    list-style:none;
}
.sidebar-menu > ul > li > a {
    align-items: center;
    border-radius: 3px;
    display: flex;
    justify-content: flex-start;
    padding: 8px 15px;
    position: relative;
    transition: all 0.2s ease-in-out 0s;
    color: #f1f1f1;
}
.sidebar-menu li a {
    color:#8A9199;
    display: block;
    font-size: 15px;
    height: auto;
    padding: 0 20px;
}
.submenu a:hover{
    text-decoration: none!important;
    /* background-color: #25354C; */
    /* width:100%; */
}
#drop-down li a:hover{
  color:rgb(0, 191, 255);
}
#sett-drop-down li a:hover{
    color:rgb(0, 191, 255);

}
.sidebar-menu > ul > li > a span {
    transition: all 0.2s ease-in-out 0s;
    display: inline-block;
    margin-left: 10px;
    white-space: nowrap;
}



.submenu::marker{
    display: :none!important;
}
    
</style>

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            @if(Auth::guard('admin')->user()->can('dashboard.view'))
            <li class="sidebar-item {{'dashboard' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href=" {{ route('dashboard.view') }}  ">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('profile.view'))
            <li class="sidebar-item {{'profiles' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('admin.view'))
             <li class="sidebar-item {{'admins' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{ route('admins.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Admins</span>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('role.view'))
            <li class="sidebar-item {{'roles' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{ route('roles.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Roles</span>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('permission.index'))
            <li class="sidebar-item {{'permissions' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{ route('permission.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Permissions</span>
                </a>
            </li>
            @endif
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                  <li class="submenu">
                      <a href="#" class="subdrop me-4" style="color:#8A9199;
                      " id="menu_arrow">  <i class="align-middle" data-feather="user" style="margin-left:-18px"></i> <span class="ms-3"> Party </span> <span> <i class="fa fa-chevron-circle-down ms-5"></i></span></a>
                      <ul id="drop-down">
                          <li>
                              <a  href="{{url('parties/view/Supplier')}}" class="mb-2"style="margin-left:-20px;">
                                  <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span class="align-middle">Supplier</span>
                              </a>
                          </li>
      
                          <li>
                              <a  href="{{url('parties/view/Customer')}}" class="mb-2"style="margin-left:-20px;">
                                  <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span class="align-middle">Customer</span>
                              </a>
                          </li>
      
                          <li>
                              <a  href="{{url('parties/view/Walkin')}}"class="mb-2" style="margin-left:-20px;">
                                  <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span class="align-middle">Walkin</span>
                              </a>
                          </li>
                          
                          
                  </li>
                  </ul>
              </div>
      
            {{-- @if(Auth::guard('admin')->user()->can('party.index') ||Auth::guard('admin')->user()->can('party.view') )

            <li class="sidebar-item {{'party' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('party.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">All Party Lists</span>
                </a>
            </li>
            @endif --}}
         
           
          
            @if(Auth::guard('admin')->user()->can('product.index'))

            <li class="sidebar-item {{'product' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('product.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Product</span>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('warehouse.index'))

            <li class="sidebar-item {{'warehouse' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('warehouse.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Warehouse</span>
                </a>
            </li>
           @endif
           @if(Auth::guard('admin')->user()->can('warehouse.transfer.index'))

            <li class="sidebar-item {{'warehouse-transfer' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('warehouse.transfer.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Warehouse Transfer</span>
                </a>
            </li>
            @endif
             
        <div id="sidebar-menu" class="sidebar-menu">
          <ul>
            <li class="submenu">
                <a href="#" class="subdrop me-4" style="color:#8A9199;
                " id="sett-menu_arrow"> <i class="fa fa-cog" aria-hidden="true" style="margin-left:-18px;"></i> <span class="ms-3"> Settings </span> <span> <i class="fa fa-chevron-circle-down ms-5"></i></span></a>
                <ul id="sett-drop-down">
                    @if(Auth::guard('admin')->user()->can('partytype.index'))
                    <li>
                        <a  href="{{route('partytype.index')}}" class="mb-2"style="margin-left:-20px;">
                            <i class="fa fa-sliders mr-2" aria-hidden="true"></i> <span class="align-middle">Party Type</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::guard('admin')->user()->can('product.category.index'))

                    <li>
                        <a  href="{{route('product.category.index')}}" class="mb-2"style="margin-left:-20px;">
                            <i class="fa fa-sliders mr-2" aria-hidden="true"></i> <span class="align-middle">Category</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::guard('admin')->user()->can('product.brand.index'))

                    <li>
                        <a  href="{{route('product.brand.index')}}"class="mb-2" style="margin-left:-20px;">
                            <i class="fa fa-sliders mr-2" aria-hidden="true"></i> <span class="align-middle">Brand</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::guard('admin')->user()->can('product.unit.index'))

                    <li>
                        <a href="{{route('product.unit.index')}}" class="mb-2"style="margin-left:-20px;">
                            <i class="fa fa-sliders mr-2" aria-hidden="true"></i> <span class="align-middle">Unit</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </li>
            </ul>
        </div>

            @if(Auth::guard('admin')->user()->can('recycle.bin'))
            <li class="sidebar-item {{'recycle-bin' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('recycle.bin')}}">
                    <i class="fa fa-recycle" aria-hidden="true"></i>
                </i> <span class="align-middle">Recycle</span>
                </a>
            </li>
            @endif
            <form method="POST" action="{{ route('admin.logout.submit')  }}">
                @csrf
            <li class="sidebar-item">
                <a href="{{route('admin.logout.submit')}} "
                class="sidebar-link"
                onclick="event.preventDefault();
                     this.closest('form').submit();">
                   <i class="fa fa-sign-out" aria-hidden="true"></i>
                   <span class="align-middle">Logout</span>
                </a>
              

                     


            </li>
        </form>
          
            

        </ul>

        
    </div>
</nav>
