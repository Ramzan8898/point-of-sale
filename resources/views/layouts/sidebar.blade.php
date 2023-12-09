<style type="text/css">
  nav .container a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    font-size: 20px;
    padding: 5px 15px;
    font-family: 'Roboto' , sans-serif;
  }

  .nav-link:hover{
    background-color: black;
    color: #ffffff;
  }


  .active {
    background-color: #74B9FA;
  }

  nav {
    background-color: indigo;
  }
</style>
<nav>
  <div class="container d-flex justify-content-between align-items-center" style="padding-top: 0px;">
    <a class="navbar-brand" href="{{url('/')}}">
      <img src="{{url('/public/favicon.png')}}" alt="GEO" width="80" height="60">
    </a>
    <a href="{{url('/employee')}}" class="nav-link {{ request()->is('employee*') ? 'active' : '' }}">Employee</a>
    <a href="{{url('/accounts')}}"  class="nav-link {{ request()->is('account*') ? 'active' : '' }}">Account</a>
    <a href="{{url('/invoices')}}" class="nav-link {{request()->is('invoice*') ? 'active' : ''}}">Sale</a>
    <a href="{{url('/add_new_product')}}" class="nav-link {{request()->is('add_new_product*') ? 'active' : ''}}">Add New Product</a>
    <a href="{{route('logout')}}" class="nav-link {{ request()->is('logout*') ? 'active' : '' }}">Logout</a>
  </div>

</nav>