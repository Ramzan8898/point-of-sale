<nav>
  <div class="container1 d-flex flex-column" >
    <a class="navbar-brand mb-5" href="{{url('/')}}">
      <img src="{{url('/public/geo-logo1.png')}}" alt="GEO" width="200" height="auto">
    </a>
    <a href="{{url('/')}}" class="nav-link text-end {{ request()->is('dash*') ? 'active' : '' }}">ڈیش بورڈ  <i class="fas fa-chart-line icon fa-flip-horizontal"></i></a>
    <a href="{{url('/employee')}}" class="nav-link text-end {{ request()->is('employee*') ? 'active' : '' }}">ملازم  <i class="fas fa-walking icon fa-flip-horizontal"></i></a>
    <a href="{{url('/accounts')}}"  class="nav-link text-end {{ request()->is('account*') ? 'active' : '' }}">کھاتہ  <i class="far fa-user-circle icon"></i></a>
    <a href="{{url('/invoices')}}" class="nav-link text-end {{request()->is('invoice*') ? 'active' : ''}}">سیل  <i class="fas fa-cart-plus icon fa-flip-horizontal"></i></a>
    <a href="{{url('/add_new_product')}}" class="nav-link text-end {{request()->is('add_new_product*') ? 'active' : ''}}">نیا پروڈکٹ شامل کریں۔ <i class="fas fa-pen-alt icon"></i></a>
    <a href="{{route('logout')}}" class="nav-link text-end {{ request()->is('logout*') ? 'active' : '' }}">لاگ آوٹ  <i class="fas fa-sign-out-alt icon fa-flip-horizontal"></i></a>
  </div>

</nav>