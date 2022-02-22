<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
            </button>
        </div>
        </div>
    </form> -->
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- user -->
        <li class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration : none; color: black">
                <img style="max-height: 35px; width: auto;" src="/img/1.jpg" alt="It-SHOP Logo" class="rounded-circle">
                {{-- <span>{{Auth::user()->name}}</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- <div class="dropdown-divider"></div> -->
                <a href="#" class="dropdown-item">
                    <i class="fas fa-id-card mr-2"></i>Edit profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->