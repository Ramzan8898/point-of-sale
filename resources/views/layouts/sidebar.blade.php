<nav>
    <div class="container1 d-flex flex-column">
        <a class="navbar-brand mb-5" href="{{url('/')}}">
            <img src="{{url('/public/geo-logo1.png')}}" alt="GEO" width="200" height="auto">
        </a>
        <a href="{{url('/')}}" class="nav-link text-end {{ request()->is('dash*') ? 'active' : '' }}">{{__('messages.dashboard')}} <i class="fas fa-chart-line icon fa-flip-horizontal"></i></a>
        <a href="{{url('/employee')}}" class="nav-link text-end {{ request()->is('employee*') ? 'active' : '' }}">{{__('messages.employee')}}<i class="fas fa-walking icon fa-flip-horizontal"></i></a>
        <a href="{{url('/accounts')}}" class="nav-link text-end {{ request()->is('account*') ? 'active' : '' }}">{{__('messages.account')}} <i class="far fa-user-circle icon"></i></a>
        <a href="{{url('/invoices')}}" class="nav-link text-end {{request()->is('invoice*') ? 'active' : ''}}">{{__('messages.sale')}}<i class="fas fa-cart-plus icon fa-flip-horizontal"></i></a>
        <a href="{{url('/products')}}" class="nav-link text-end {{request()->is('products*') ? 'active' : ''}}">{{__('messages.products')}}<i class="fas fa-pen-alt icon"></i></a>
        <a href="{{route('logout')}}" class="nav-link text-end {{ request()->is('logout*') ? 'active' : '' }}">{{__('messages.logout')}}<i class="fas fa-sign-out-alt icon fa-flip-horizontal"></i></a>
    </div>

</nav>