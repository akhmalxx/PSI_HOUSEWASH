<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">HouseWash</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">HW</a>
        </div>
        <ul class="sidebar-menu">
            {{-- <li class="menu-header">Dashboard</li> --}}

            <li class='{{ Request::is('dashboard') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class='{{ Request::is('product') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ url('product') }}"><i
                        class="fas fa-th-large fa-lg"></i><span>Inventory</span></a>
            </li>

            {{-- <li class='{{ Request::is('cashier') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ url('cashier') }}"><i
                        class="fa-solid fa-cart-shopping"></i><span>Cashier</span></a>
            </li> --}}
            {{-- <li class="{{ Request::is('ourteam') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('ourteam') }}"><i class="fas fa-users fa-lg"></i><span>Our Team</span></a>
            </li>

            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('contact') }}"><i class="fas fa-address-card fa-lg"></i><span>Contact</span></a>
            </li> --}}

            {{-- <li class="{{ Request::is('about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('about') }}"><i class="fas fa-question-circle fa-lg"></i><span>About Us</span></a>
            </li> --}}

            {{-- <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="fas fa-comment-alt fa-lg"></i><span>Feedback</span></a>
            </li> --}}
    </aside>
</div>
