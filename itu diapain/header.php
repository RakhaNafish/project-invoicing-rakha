<nav class="app-header navbar navbar-expand bg-dark" data-bs-theme="dark">
    <style>
        .user-image {
            width: 32px;
            height: 32px;
            object-fit: cover;
        }
    </style>
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <ul class="">

        </ul>

        <ul class="navbar-nav ms-auto" role="navigation" aria-label="Navigation 2">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../customer/izinmin.jfif" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline">Azura Mishimoto</span>
                </a>
            </li>
            <!--end::User Menu Dropdown-->

        </ul>
    </div>
</nav>