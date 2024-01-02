<nav>
  <div class="container1 d-flex flex-column" >
    <a class="navbar-brand mb-5" href="{{url('/')}}">
      <img src="{{url('/public/geo-logo1.png')}}" alt="GEO" width="200" height="auto">
    </a>
    <a href="{{url('/')}}" class="nav-link {{ request()->is('*') ? 'active' : '' }}"><i class="fas fa-chart-line icon"></i>Dashboard</a>
    <a href="{{url('/employee')}}" class="nav-link {{ request()->is('employee*') ? 'active' : '' }}"><i class="fas fa-walking icon"></i>Employee</a>
    <a href="{{url('/accounts')}}"  class="nav-link {{ request()->is('account*') ? 'active' : '' }}"><i class="far fa-user-circle icon"></i>Account</a>
    <a href="{{url('/invoices')}}" class="nav-link {{request()->is('invoice*') ? 'active' : ''}}"><i class="fas fa-cart-plus icon"></i>Sale</a>
    <a href="{{url('/add_new_product')}}" class="nav-link {{request()->is('add_new_product*') ? 'active' : ''}}"><i class="fas fa-pen-alt icon"></i>Add New Product</a>
    <a href="{{route('logout')}}" class="nav-link {{ request()->is('logout*') ? 'active' : '' }}"><i class="fas fa-sign-out-alt icon "></i>Logout</a>
  </div>

</nav>