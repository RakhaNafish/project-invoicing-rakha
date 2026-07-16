<aside class="app-sidebar bg-dark" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <i class="nav-icon bi bi-receipt"></i>
            <span class="brand-text">Invoicing App</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav>
            <ul class="nav sidebar-menu flex-column">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="../dashboard/dashboard.php"
                        class="nav-link <?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-grid-1x2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- Master Data -->
                <li class="nav-header fw-bold text-uppercase">
                    Master Data
                </li>

                <li class="nav-item">
                    <a href="../item/index.php" class="nav-link <?= ($activePage ?? '') == 'item' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>Item</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../customer/index.php"
                        class="nav-link <?= ($activePage ?? '') == 'customer' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../pic/index.php" class="nav-link <?= ($activePage ?? '') == 'pic' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-people"></i>
                        <p>PIC</p>
                    </a>
                </li>

                <!-- Transaction -->
                <li class="nav-header fw-bold text-uppercase">
                    Transactions
                </li>

                <li class="nav-item">
                    <a href="../invoice/table.invoice.php"
                        class="nav-link <?= ($activePage ?? '') == 'invoice' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-receipt"></i>
                        <p>Invoice</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../dashboard/payment.php"
                        class="nav-link <?= ($activePage ?? '') == 'payment' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-credit-card"></i>
                        <p>Payment</p>
                    </a>
                </li>

                <!-- Report -->
                <li class="nav-header fw-bold text-uppercase">
                    Reports
                </li>

                <li class="nav-item">
                    <a href="../revenue/revenue.php"
                        class="nav-link <?= ($activePage ?? '') == 'revenue' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-graph-up"></i>
                        <p>Revenue</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../dashboard/arrears.php"
                        class="nav-link <?= ($activePage ?? '') == 'arrears' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-clipboard2-data"></i>
                        <p>Overdue</p>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-header fw-bold text-uppercase">
                    Settings
                </li>
                <li class="nav-item">
                    <a href="../company/index.php"
                        class="nav-link <?= ($activePage ?? '') == 'company' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-buildings"></i>
                        <p>Company</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../user/index.php" class="nav-link <?= ($activePage ?? '') == 'user' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-person"></i>
                        <p>Manage User</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>