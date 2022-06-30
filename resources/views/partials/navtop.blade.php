<nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow nav justify-content-end" style="position:fixed;left:0;right:0;z-index:1030;">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('home')? 'active': ''}}" href="{{URL::route('home')}}" data-toggle="tooltip" title="Inicio">
                <i class="fas fa-home fa-lg"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('inventarios')? 'active': ''}}" href="{{URL::route('inventarios')}}" data-toggle="tooltip" title="Inventarios">
                <i class="fas fa-clipboard-list"></i>
                <span>Inventarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('ventas')? 'active': ''}}" href="{{URL::route('ventas')}}" data-toggle="tooltip" title="Ventas">
                <i class="fas fa-store-alt"></i>
                <span>Ventas</span>
            </a>
        </li>
    </ul>
</nav>