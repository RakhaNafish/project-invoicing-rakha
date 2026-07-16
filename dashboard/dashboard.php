<?php

// ============================================================
// DASHBOARD DATA — dummy, replace with real DB queries
// ============================================================

$active_year = (int) date('Y');
$active_month = (int) date('n');

$month_short = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
$month_full = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];

// ── 1. KPI SUMMARY (max 4 cards) ─────────────────────────────
$total_revenue = 543000000;
$total_revenue_prev = 498000000;
$total_unpaid = 18400000;
$total_unpaid_prev = 15200000;
$total_overdue = 6600000;
$total_overdue_prev = 8100000;
$total_invoice = 195;
$total_invoice_prev = 210;

// ── 2. REVENUE ANALYTICS (single main chart) ──────────────────
// Daily → per day name (Sun..Sat)
$revenue_daily = [4100000, 3850000, 5200000, 2950000, 7800000, 9500000, 8200000];
$day_labels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

// Weekly → per week of current month (matches revenue.php "weekly")
$revenue_monthly = [18500000, 21200000, 19800000, 23400000, 15600000];
$week_labels = ['Week 1 ' . $month_full[$active_month], 'Week 2 ' . $month_full[$active_month], 'Week 3 ' . $month_full[$active_month], 'Week 4 ' . $month_full[$active_month], 'Week 5 ' . $month_full[$active_month]];

// Monthly → per month, Jan-Dec (matches revenue.php "monthly")
$revenue_yearly = [42000000, 38000000, 55000000, 49000000, 61000000, 58000000, 72000000, 65000000, 70000000, 63000000, 75000000, 68900000];
$month_labels = [];
for ($m = 1; $m <= 12; $m++) {
    $month_labels[] = $month_full[$m];
}

// ── 3. TOP SELLING PRODUCTS (top 5 only) ─────────────────────
$top_products = [
    ['name' => 'Laptop Asus VivoBook', 'sold' => 42],
    ['name' => 'Smartphone Samsung', 'sold' => 35],
    ['name' => 'Monitor LG 24 Inch', 'sold' => 28],
    ['name' => 'Printer Epson L3210', 'sold' => 21],
    ['name' => 'Gaming Headset', 'sold' => 18],
];

// ── 5. OVERDUE CUSTOMERS (past due date) ──────────────────────
$overdue_customers = [
    ['customer' => 'Doni Setiawan', 'amount' => 1500000, 'due_date' => '2026-07-02'],
    ['customer' => 'Rina Kartika', 'amount' => 2400000, 'due_date' => '2026-06-28'],
    ['customer' => 'Bagus Prakoso', 'amount' => 900000, 'due_date' => '2026-07-05'],
    ['customer' => 'Siti Nurhaliza', 'amount' => 1800000, 'due_date' => '2026-06-20'],
];

// ── 6. RECENT TRANSACTIONS (max 5) ────────────────────────────
$recent_transactions = [
    ['no' => 'INV-013', 'customer' => 'Teguh Wibowo', 'total' => 1900000, 'status' => 'Pending'],
    ['no' => 'INV-012', 'customer' => 'Laila Sari', 'total' => 450000, 'status' => 'Paid'],
    ['no' => 'INV-011', 'customer' => 'Fajar Nugroho', 'total' => 5600000, 'status' => 'Paid'],
    ['no' => 'INV-010', 'customer' => 'Maya Anggraini', 'total' => 2250000, 'status' => 'Paid'],
    ['no' => 'INV-009', 'customer' => 'Doni Setiawan', 'total' => 1500000, 'status' => 'Overdue'],
];

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}
function pct_change(int $a, int $b): string
{
    if ($b === 0)
        return '+0%';
    $p = round(($a - $b) / $b * 100, 1);
    return ($p >= 0 ? '+' : '') . $p . '%';
}
function trend_class(int $a, int $b, bool $lowerIsBetter = false): string
{
    $good = $lowerIsBetter ? $a <= $b : $a >= $b;
    return $good ? 'trend-up' : 'trend-down';
}
function trend_icon(int $a, int $b): string
{
    return $a >= $b ? 'bi-arrow-up-short' : 'bi-arrow-down-short';
}
function days_overdue(string $date): int
{
    $due = new DateTime($date);
    $today = new DateTime();
    $diff = $today->diff($due);
    return $diff->days;
}
function format_date_id(string $date): string
{
    $bulan = ['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'];
    [$y, $m, $d] = explode('-', $date);
    return $d . ' ' . $bulan[$m] . ' ' . $y;
}


?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* ── Base rhythm ── */
        .app-main {
            background: var(--bs-tertiary-bg);
        }

        .app-content {
            padding-bottom: 2rem;
        }

        .dash-section {
            margin-bottom: 2rem;
        }

        .dash-section-title {
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: var(--bs-secondary-color);
            margin-bottom: .9rem;
        }

        /* ── KPI cards ── */
        .kpi-card {
            border: 1px solid var(--bs-border-color);
        }

        .kpi-card .card-body {
            padding: 1.25rem 1.35rem;
        }

        .kpi-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-value {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .kpi-label {
            font-size: .78rem;
            color: var(--bs-secondary-color);
            font-weight: 500;
        }

        .trend {
            font-size: .8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .trend-up {
            color: #2fb380;
        }

        .trend-down {
            color: #e05260;
        }

        /* ── Top products ── */
        .product-row {
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: .65rem 0;
        }

        .product-row+.product-row {
            border-top: 1px solid var(--bs-border-color);
        }

        .product-rank {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: var(--bs-tertiary-bg);
            font-size: .75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ── Cards general ── */
        .card {
            border: 1px solid var(--bs-border-color);
            box-shadow: none;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--bs-border-color);
        }

        @media (max-width: 767.98px) {
            .card-header {
                flex-wrap: wrap;
                gap: .5rem;
            }
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php $activePage = 'dashboard';
        include "../component/sidebar.php"; ?>

        <div class="app-main">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Dashboard</h3>
                                <small class="text-muted"><?= date('l, d') ?> <?= $month_full[$active_month] ?>
                                    <?= $active_year ?></small>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a>Dashboard</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4">

                <!-- ══ 1. KPI SUMMARY ══ -->
                <div class="dash-section">
                    <div class="row g-3">
                        <div class="col-6 col-lg-3">
                            <div class="card kpi-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="kpi-icon" style="background:rgba(47,179,128,.15)"><i
                                                class="bi bi-cash-coin" style="color:#2fb380"></i></span>
                                        <div class="kpi-value"><?= rupiah($total_revenue) ?></div>
                                    </div>
                                    <div class="kpi-label">Total Revenue</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="card kpi-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="kpi-icon" style="background:rgba(217,164,65,.15)"><i
                                                class="bi bi-hourglass-split" style="color:#d9a441"></i></span>
                                        <div class="kpi-value"><?= rupiah($total_unpaid) ?></div>
                                    </div>
                                    <div class="kpi-label">Total Unpaid</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="card kpi-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="kpi-icon" style="background:rgba(224,82,96,.15)"><i
                                                class="bi bi-exclamation-octagon" style="color:#e05260"></i></span>
                                        <div class="kpi-value"><?= rupiah($total_overdue) ?></div>
                                    </div>
                                    <div class="kpi-label">Total Overdue</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-3">
                            <div class="card kpi-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="kpi-icon" style="background:rgba(108,142,235,.15)"><i
                                                class="bi bi-file-earmark-text" style="color:#6c8eeb"></i></span>
                                        <div class="kpi-value"><?= $total_invoice ?></div>
                                    </div>
                                    <div class="kpi-label">Total Invoice</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ══ 2. REVENUE ANALYTICS + TOP SELLING PRODUCTS ══════ -->
                <div class="dash-section">
                    <div class="row g-3">
                        <div class="col-12 col-lg-8">
                            <div class="dash-section-title">Revenue Analytics</div>
                            <div class="card h-100">
                                <div
                                    class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <h3 class="card-title mb-0 fs-6">Revenue</h3>
                                    <div class="d-flex align-items-center ms-auto">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-primary active period-btn"
                                                data-period="daily">Daily</button>
                                            <button class="btn btn-sm btn-outline-primary period-btn"
                                                data-period="weekly">Weekly</button>
                                            <button class="btn btn-sm btn-outline-primary period-btn"
                                                data-period="monthly">Monthly</button>
                                        </div>
                                    </div>
                                        <div class="d-flex justify-content-between align-items-center ms-auto">
                                            <a href="../revenue/revenue.php"
                                                class="btn btn-sm btn-link text-decoration-none">
                                                View Revenue <i class="bi bi-arrow-right ms-1"></i></a>
                                        </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="mainChart" height="110"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="dash-section-title">Top Selling Products</div>
                            <div class="card h-100">
                                <div class="card-body">
                                    <?php foreach ($top_products as $i => $p): ?>
                                        <div class="product-row">
                                            <span class="product-rank"><?= $i + 1 ?></span>
                                            <div class="flex-grow-1">
                                                <div class="small fw-semibold"><?= $p['name'] ?></div>
                                            </div>
                                            <div class="text-end small fw-semibold"><?= $p['sold'] ?> Sold</div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="text-center border-top py-2">
                                    <a href="../revenue/revenue.php"
                                        class="btn btn-sm btn-link text-decoration-none">View
                                        Detail Top Selling
                                        <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ══ 3. RECENT TRANSACTIONS + OVERDUE CUSTOMERS ═══════ -->
                <div class="dash-section pt-4">
                    <div class="row g-3">
                        <div class="col-12 col-lg-7">
                            <div class="dash-section-title">Recent Transactions</div>
                            <div class="card h-100">
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="table-responsive flex-grow-1">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Customer</th>
                                                    <th class="text-end">Total</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_transactions as $t):
                                                    switch ($t['status']) {
                                                        case 'Paid':
                                                            $badge = 'success';
                                                            break;

                                                        case 'Pending':
                                                            $badge = 'warning';
                                                            break;

                                                        case 'Unpaid':
                                                            $badge = 'danger';
                                                            break;

                                                        default:
                                                            $badge = 'danger';
                                                            break;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?= $t['no'] ?></td>
                                                        <td><?= htmlspecialchars($t['customer']) ?></td>
                                                        <td class="text-end fw-semibold"><?= rupiah($t['total']) ?></td>
                                                        <td class="text-center">
                                                            <span
                                                                class="badge text-bg-<?= $badge ?>"><?= $t['status'] ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center border-top py-2">
                                        <a href="../invoice/table.invoice.php"
                                            class="btn btn-sm btn-link text-decoration-none">View All Transactions
                                            <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="dash-section-title">Overdue Customers</div>
                            <div class="card h-100">
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="table-responsive flex-grow-1">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th class="text-end">Unpaid</th>
                                                    <th class="text-center">Overdue Since</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($overdue_customers as $o): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($o['customer']) ?></td>
                                                        <td class="text-end fw-semibold text-danger">
                                                            <?= rupiah($o['amount']) ?></td>
                                                        <td class="text-center small">
                                                            <?= format_date_id($o['due_date']) ?>
                                                            <div class="text-muted" style="font-size:.72rem">
                                                                <?= days_overdue($o['due_date']) ?> days</div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center border-top py-2">
                                        <a href="../dashboard/arrears.php"
                                            class="btn btn-sm btn-link text-decoration-none">View All Overdue
                                            <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /container-fluid -->
        </div>
        <?php include "../component/footer.php"; ?>
    </div>

    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const REVENUE_COLOR = '#2fb380';

        const DATA = {
            daily: { labels: <?= json_encode($day_labels) ?>, revenue: <?= json_encode($revenue_daily) ?> },
            weekly: { labels: <?= json_encode($week_labels) ?>, revenue: <?= json_encode($revenue_monthly) ?> },
            monthly: { labels: <?= json_encode($month_labels) ?>, revenue: <?= json_encode($revenue_yearly) ?> },
        };

        function rupiahShort(v) {
            if (v >= 1e9) return 'Rp ' + (v / 1e9).toFixed(1) + 'B';
            if (v >= 1e6) return 'Rp ' + (v / 1e6).toFixed(1) + 'M';
            return 'Rp ' + (v / 1e3).toFixed(0) + 'K';
        }
        function rupiahFull(v) { return 'Rp ' + v.toLocaleString('id-ID'); }

        let mainChart = null;
        function buildMainChart(period) {
            const ctx = document.getElementById('mainChart');
            if (!ctx) return;
            if (mainChart) mainChart.destroy();
            const d = DATA[period];
            mainChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: d.labels,
                    datasets: [
                        {
                            label: 'Revenue',
                            data: d.revenue,
                            borderColor: REVENUE_COLOR,
                            backgroundColor: REVENUE_COLOR + '1f',
                            borderWidth: 2.5,
                            pointBackgroundColor: REVENUE_COLOR,
                            pointRadius: 3,
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: c => rupiahFull(c.parsed.y) } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { callback: rupiahShort }, grid: { color: 'rgba(255,255,255,.06)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
        buildMainChart('daily');

        const periodButtons = document.querySelectorAll('.period-btn');

        periodButtons.forEach(button => {
            button.addEventListener('click', function () {

                // Reset button
                periodButtons.forEach(btn => {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-primary');
                });

                this.classList.add('active', 'btn-primary');
                this.classList.remove('btn-outline-primary');

                buildMainChart(this.dataset.period);
            });
        });
    </script>
</body>

</html>