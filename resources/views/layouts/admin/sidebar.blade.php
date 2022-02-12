<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/img/logo.png" alt="It-SHOP Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">IT-SHOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link active">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>@lang('category.title.list')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>