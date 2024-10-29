<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <?php 
          $role=  auth()->user()->role;
        ?>
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard {{$role}}</span>
            </a>
        </li>
        @foreach ($globalData['modules'] as $module)
            
        
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/{{$module->slug}}">
                <i class="{{$module->icon}} menu-icon"></i>
                <span class="menu-title">{{$module->name}}</span>
            </a>
        </li>
        @endforeach
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('module.index')}}">
                <i class="ti-medall menu-icon"></i>
                <span class="menu-title">Modules</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('permission.index')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Permission</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('clients.index')}}">
                <i class="ti-id-badge menu-icon"></i>
                <span class="menu-title">Clients</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="ti-clipboard menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('medicines.index')}}">
                <i class="ti-na menu-icon"></i>
                <span class="menu-title">Medicines</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('doctors.index')}}">
                <i class="ti-support menu-icon"></i>
                <span class="menu-title">Doctors</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('hq.index')}}">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Head Quarters</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('suppliers.index')}}">
                <i class="ti-bag menu-icon"></i>
                <span class="menu-title">Suppliers</span>
            </a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="{{route('stocks.index')}}">
                <i class="ti-package menu-icon"></i>
                <span class="menu-title">Stocks</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('supplies.index')}}">
                <i class="ti-truck menu-icon"></i>
                <span class="menu-title">Supplies</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{route('settings')}}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        
    </ul>
</nav>
