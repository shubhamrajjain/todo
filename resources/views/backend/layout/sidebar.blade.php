<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-light">TODO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('tasks.index')}}"
                        class="nav-link {{Route::currentRouteName() == 'tasks.index'? 'active' : ''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            All Tasks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('tasks.complete')}}"
                        class="nav-link {{Route::currentRouteName() == 'tasks.complete'? 'active' : ''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Completed Tasks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('tasks.pending')}}"
                        class="nav-link {{Route::currentRouteName() == 'tasks.pending'? 'active' : ''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Pending Tasks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('users.index')}}"
                        class="nav-link {{Route::currentRouteName() == 'users.index'? 'active' : ''}}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>