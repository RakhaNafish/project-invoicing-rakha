<aside class="app-sidebar bg-body-secondary">

    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <span class="brand-text">Invoicing App</span>
        </a>
    </div>
    
    <div class="sidebar-wrapper">
        <nav>
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item menu-open">
                    <a href="../dashboard/dashboard.php" class="nav-link <?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-pie-chart"></i>
                        <p>Dashboard</p>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../company/index.php" class="nav-link <?= ($activePage ?? '') == 'company' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-buildings"></i>
                                <p>Company</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="../revenue/revenue.php" class="nav-link <?= ($activePage ?? '') == 'revenue' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-bar-chart"></i>
                                <p>Revenue</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="../item/index.php" class="nav-link <?= ($activePage ?? '') == 'item' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>Item</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../customer/index.php" class="nav-link <?= ($activePage ?? '') == 'customer' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Customer</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../invoice/table.invoice.php" class="nav-link <?= ($activePage ?? '') == 'invoice' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Invoice</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../dashboard/payment.php" class="nav-link <?= ($activePage ?? '') == 'payment' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-wallet2"></i>
                                <p>Payment</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../dashboard/arrears.php" class="nav-link <?= ($activePage ?? '') == 'arrears' ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-clipboard2-data"></i>
                                <p>Overdue</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

</aside>