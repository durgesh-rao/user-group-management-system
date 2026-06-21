<style>
    #left-sidebar {
        background-color: #0f3f3c !important;
    }

    #left-sidebar .nav-link {
        color: #fff;
        font-weight: 500;
        font-size: 18px;
    }

    .brand-link {
        color: #fff;
        font-weight: 900;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4" id="left-sidebar">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Laravel Task</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('group.index') }}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>Add Group</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-bars nav-icon"></i>
                        <p>Add User</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</aside>
