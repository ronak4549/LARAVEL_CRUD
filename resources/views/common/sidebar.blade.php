<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My-Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" style="{{ Route::currentRouteName() == 'home' ? 'background:#a1b2e6!important;' : '' }}"
            href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Management
    </div> --}}
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDown"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-user-alt"></i>
            <span>User Management</span>
        </a>
        <div id="taTpDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">List</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Add New</a>
                <a class="collapse-item" href="{{ route('users.import') }}">Import Data</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Divider -->

    @hasrole('Admin')
        <!-- Heading -->
        {{-- <div class="sidebar-heading">
            Admin Section
        </div> --}}
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Masters</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Role & Permissions</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
                </div>
            </div>
        </li>
    @endhasrole
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link"
            style="{{ Route::currentRouteName() == 'crud.index' ? 'background:#a1b2e6!important;' : '' }}"
            href="{{ route('crud.index') }}">
            <i class="fas fa-solid fa-code"></i>
            <span>CRUD</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link"
            style="{{ Route::currentRouteName() == 'crud.fileupload' ? 'background:#a1b2e6!important;' : '' }}"
            href="{{ route('crud.fileupload') }}">
            <i class="fas fa-solid fa-file"></i>
            <span>Excel_Upload</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link"
            style="{{ Route::currentRouteName() == 'crud.tableViewIndex' ? 'background:#a1b2e6!important;' : '' }}"
            href="{{ route('crud.tableViewIndex') }}">
            <i class="fas fa-solid fa-camera-retro"></i>
            <span>Table_View Data</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link"
            style="{{ Route::currentRouteName() == 'send_mail' ? 'background:#a1b2e6!important;' : '' }}"
            href="{{ route('send_mail') }}">
            <i class="fas fa-solid fa-camera-retro"></i>
            <span>Send Test-Mail</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
