<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        @if(Auth::user()->idRol == 3 )
        <li class="nav-item ">
            <a href="#" class="nav-link">
                <p>
                    Gestión de sucursales
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            
            <ul class="nav nav-treeview">
            
                <li class="nav-item" @click="menu = 1">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bodega</p>
                    </a>
                </li>
                <li class="nav-item" @click="menu = 2">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sucursales</p>
                    </a>
                </li>
                <li class="nav-item" @click="menu = 3">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Productos</p>
                    </a>
                </li>
                <li class="nav-item" @click="menu = 4">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Proveedores</p>
                    </a>
                </li>
            </ul>
            
        </li>
        @endif
        @if(Auth::user()->idRol == 1 )
        <li class="nav-item ">
            <a href="#" class="nav-link">
                <p>
                    Gestión de usuarios
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            
            <ul class="nav nav-treeview">
                <li class="nav-item" @click="menu = 5">
                    <a href="/usuario" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rol" class="nav-link" @click="menu = 6">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item" @click="menu = 7">
                    <a href="/permiso" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Permisos</p>
                    </a>
                </li>
            </ul>
            
        </li>
        @endif
        @if(Auth::user()->idRol == 2 )
        <li class="nav-item " @click="menu = 8">
            <a href="" class="nav-link">
                <p>
                    Facturación
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
        <li class="nav-item"  @click="menu = 9">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Facturas</p>
            </a>
        </li>
        </li>
        <li class="nav-item ">
            <a href="#" class="nav-link">
                <p>
                    Configuración
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"  @click="menu = 10">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>IVA</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
</nav>
<!-- /.sidebar-menu -->