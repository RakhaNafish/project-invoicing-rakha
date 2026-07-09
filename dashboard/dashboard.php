<?php

// ============================================================
// DASHBOARD DATA — dummy, replace with real DB queries
// ============================================================

$active_year = (int) date('Y');
$active_month = (int) date('n');

$month_short = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
$month_full = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];

// ── 1. KPI SUMMARY (max 4 cards) ─────────────────────────────
// These 4 numbers answer: "how's revenue today, do I have unpaid
// invoices, how busy is the business, and is it growing." Nothing
// beyond that goes here — extra KPIs belong on the Report page.
$revenue_today = 25500000;
$revenue_yesterday = 21000000;
$outstanding_total = 18400000;
$outstanding_total_prev = 15200000;
$outstanding_count = 9;
$invoice_this_month = 195;
$invoice_last_month = 210;
$total_customer = 342;
$total_customer_prev = 331;

// ── 2. REVENUE ANALYTICS (single main chart) ─────────────────
$revenue_hourly = [1250000, 450000, 3200000, 900000, 2100000, 750000, 4800000, 300000, 1500000, 2250000, 5600000, 450000, 1900000];
$hour_labels = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

$revenue_daily_week = [3850000, 5200000, 2950000, 7800000, 9500000, 8200000, 4100000];
$day_labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

$revenue_daily_month = [850000, 1200000, 950000, 2100000, 1800000, 3200000, 2750000, 1100000, 1400000, 980000, 2300000, 1950000, 2800000, 3100000, 900000, 1600000, 2050000, 1750000, 2900000, 3400000, 2200000, 1300000, 1500000, 2600000, 1850000, 3050000, 2400000, 1700000, 2100000, 2800000];
$date_labels = range(1, count($revenue_daily_month));

$revenue_12_months = [42000000, 38000000, 55000000, 49000000, 61000000, 58000000, 72000000, 65000000, 70000000, 63000000, 75000000, 68900000];
$month_12_labels = [];
for ($i = 11; $i >= 0; $i--) {
    $m = $active_month - $i;
    $y = $active_year;
    if ($m <= 0) {
        $m += 12;
        $y--;
    }
    $month_12_labels[] = $month_short[$m] . ' ' . $y;
}

// ── 3. BUSINESS ALERTS (only shown when something needs action) ─
// Empty array = "No urgent business alerts." Keep this list short;
// it should only contain things that cost money if ignored.
$business_alerts = [
    ['level' => 'danger', 'icon' => 'bi-exclamation-octagon', 'title' => '14 invoices overdue', 'desc' => 'Rp 6,600,000 unpaid, past due date.'],
    ['level' => 'danger', 'icon' => 'bi-calendar-x', 'title' => '4 invoices due today', 'desc' => 'Rp 2,100,000 due for collection today.'],
    ['level' => 'warning', 'icon' => 'bi-box-seam', 'title' => 'Stock running low', 'desc' => 'Monitor LG 24" has only 3 units left.'],
    ['level' => 'warning', 'icon' => 'bi-person-x', 'title' => 'Customers paying late', 'desc' => '3 customers overdue for more than 30 days.'],
];

// ── 4. TOP SELLING PRODUCTS (top 5 only) ─────────────────────
$top_products = [
    ['name' => 'Laptop Asus VivoBook', 'sold' => 42, 'revenue' => 31500000],
    ['name' => 'Smartphone Samsung', 'sold' => 35, 'revenue' => 14000000],
    ['name' => 'Monitor LG 24 Inch', 'sold' => 28, 'revenue' => 5040000],
    ['name' => 'Printer Epson L3210', 'sold' => 21, 'revenue' => 4620000],
    ['name' => 'Gaming Headset', 'sold' => 18, 'revenue' => 630000],
];

// ── 5. RECENT TRANSACTIONS (max 5) ────────────────────────────
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

$change_revenue = pct_change($revenue_today, $revenue_yesterday);
$change_outstanding = pct_change($outstanding_total, $outstanding_total_prev);
$change_invoice = pct_change($invoice_this_month, $invoice_last_month);
$change_customer = pct_change($total_customer, $total_customer_prev);

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
        /* ── Base rhythm ─────────────────────────────────────── */
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

        /* ── KPI cards ───────────────────────────────────────── */
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

        /* ── Alerts ──────────────────────────────────────────── */
        .alert-row {
            border-left: 3px solid;
            padding: .7rem 1rem;
            border-radius: 6px;
            display: flex;
            gap: .75rem;
            align-items: flex-start;
        }

        .alert-row.level-danger {
            border-left-color: #e05260;
            background: rgba(224, 82, 96, .07);
        }

        .alert-row.level-warning {
            border-left-color: #d9a441;
            background: rgba(217, 164, 65, .07);
        }

        .no-alerts {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #2fb380;
            padding: .6rem 0;
        }

        /* ── Chart card ──────────────────────────────────────── */
        .period-tab .nav-link {
            border-radius: 6px;
            font-size: .82rem;
            padding: 4px 12px;
            color: var(--bs-secondary-color);
        }

        .period-tab .nav-link.active {
            background: var(--bs-primary);
            color: #fff;
        }

        /* ── Top products ────────────────────────────────────── */
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

        /* ── Cards general ───────────────────────────────────── */
        .card {
            border: 1px solid var(--bs-border-color);
            box-shadow: none;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--bs-border-color);
        }

        @media (max-width: 767.98px) {
            .period-tab {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .card-header {
                flex-wrap: wrap;
                gap: .5rem;
            }
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php $activePage = 'dashboard';
        include "../itu diapain/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header px-3 pt-3 pb-2">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Dashboard</h3>
                                <small class="text-muted"><?= date('l, d') ?> <?= $month_full[$active_month] ?>
                                    <?= $active_year ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-2">

                    <!-- ══ 1. KPI SUMMARY ═══════════════════════════════════ -->
                    <div class="dash-section">
                        <div class="row g-3">
                            <div class="col-6 col-lg-3">
                                <div class="card kpi-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="kpi-icon" style="background:rgba(47,179,128,.15)"><i
                                                    class="bi bi-cash-coin" style="color:#2fb380"></i></span>
                                            <span
                                                class="trend <?= trend_class($revenue_today, $revenue_yesterday) ?>"><i
                                                    class="bi <?= trend_icon($revenue_today, $revenue_yesterday) ?>"></i><?= $change_revenue ?></span>
                                        </div>
                                        <div class="kpi-value"><?= rupiah($revenue_today) ?></div>
                                        <div class="kpi-label">Today's Revenue</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3">
                                <div class="card kpi-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="kpi-icon" style="background:rgba(217,164,65,.15)"><i
                                                    class="bi bi-hourglass-split" style="color:#d9a441"></i></span>
                                            <span
                                                class="trend <?= trend_class($outstanding_total, $outstanding_total_prev, true) ?>"><i
                                                    class="bi <?= trend_icon($outstanding_total, $outstanding_total_prev) ?>"></i><?= $change_outstanding ?></span>
                                        </div>
                                        <div class="kpi-value"><?= rupiah($outstanding_total) ?></div>
                                        <div class="kpi-label">Outstanding Invoice · <?= $outstanding_count ?> unpaid
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3">
                                <div class="card kpi-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="kpi-icon" style="background:rgba(108,142,235,.15)"><i
                                                    class="bi bi-file-earmark-text" style="color:#6c8eeb"></i></span>
                                            <span
                                                class="trend <?= trend_class($invoice_this_month, $invoice_last_month) ?>"><i
                                                    class="bi <?= trend_icon($invoice_this_month, $invoice_last_month) ?>"></i><?= $change_invoice ?></span>
                                        </div>
                                        <div class="kpi-value"><?= $invoice_this_month ?></div>
                                        <div class="kpi-label">Total Invoice · this month</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3">
                                <div class="card kpi-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="kpi-icon" style="background:rgba(160,120,235,.15)"><i
                                                    class="bi bi-people" style="color:#a078eb"></i></span>
                                            <span
                                                class="trend <?= trend_class($total_customer, $total_customer_prev) ?>"><i
                                                    class="bi <?= trend_icon($total_customer, $total_customer_prev) ?>"></i><?= $change_customer ?></span>
                                        </div>
                                        <div class="kpi-value"><?= $total_customer ?></div>
                                        <div class="kpi-label">Total Customer</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ══ 2. BUSINESS ALERTS ═══════════════════════════════ -->
                    <div class="dash-section">
                        <div class="dash-section-title">Business Alerts</div>
                        <div class="card">
                            <div class="card-body">
                                <?php if (empty($business_alerts)): ?>
                                    <div class="no-alerts">
                                        <i class="bi bi-check-circle fs-5"></i>
                                        <span>No urgent business alerts.</span>
                                    </div>
                                <?php else: ?>
                                    <div class="row g-2">
                                        <?php foreach ($business_alerts as $a): ?>
                                            <div class="col-12 col-md-6">
                                                <div class="alert-row level-<?= $a['level'] ?>">
                                                    <i class="bi <?= $a['icon'] ?> text-<?= $a['level'] ?>"></i>
                                                    <div>
                                                        <div class="fw-semibold small"><?= $a['title'] ?></div>
                                                        <small class="text-muted"><?= $a['desc'] ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- ══ 3. REVENUE ANALYTICS ═════════════════════════════ -->
                    <div class="dash-section">
                        <div class="dash-section-title">Revenue Analytics</div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0 fs-6">Revenue Trend</h3>
                                <ul class="nav period-tab gap-1" id="periodTab">
                                    <li class="nav-item"><a class="nav-link active" href="#"
                                            data-period="daily">Daily</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#" data-period="weekly">Weekly</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#" data-period="monthly">Monthly</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#" data-period="yearly">Yearly</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <canvas id="mainChart" height="90"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- ══ 4. TOP SELLING PRODUCTS + 5. RECENT TRANSACTIONS ═ -->
                    <div class="dash-section">
                        <div class="row g-3">
                            <div class="col-12 col-lg-5">
                                <div class="dash-section-title">Top Selling Products</div>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php foreach ($top_products as $i => $p): ?>
                                            <div class="product-row">
                                                <span class="product-rank"><?= $i + 1 ?></span>
                                                <div class="flex-grow-1">
                                                    <div class="small fw-semibold"><?= $p['name'] ?></div>
                                                    <small class="text-muted"><?= $p['sold'] ?> sold</small>
                                                </div>
                                                <div class="text-end small fw-semibold"><?= rupiah($p['revenue']) ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

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
                                                    <?php foreach ($recent_transactions as $t): ?>
                                                        <tr>
                                                            <td><?= $t['no'] ?></td>
                                                            <td><?= htmlspecialchars($t['customer']) ?></td>
                                                            <td class="text-end fw-semibold"><?= rupiah($t['total']) ?></td>
                                                            <td class="text-center">
                                                                <?php
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
                                                                        $badge = 'secondary';
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class="badge <?= $badge ?>"><?= $t['status'] ?></span>
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
                        </div>
                    </div>

                </div><!-- /container-fluid -->
            </div>
        </div>

        <?php include "../itu diapain/footer.php"; ?>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const DATA = {
            daily: { labels: <?= json_encode($hour_labels) ?>, values: <?= json_encode($revenue_hourly) ?>, color: '#2fb380' },
            weekly: { labels: <?= json_encode($day_labels) ?>, values: <?= json_encode($revenue_daily_week) ?>, color: '#6c8eeb' },
            monthly: { labels: <?= json_encode($date_labels) ?>, values: <?= json_encode($revenue_daily_month) ?>, color: '#d9a441' },
            yearly: { labels: <?= json_encode($month_12_labels) ?>, values: <?= json_encode($revenue_12_months) ?>, color: '#a078eb' }
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
                    datasets: [{
                        label: 'Revenue',
                        data: d.values,
                        borderColor: d.color,
                        backgroundColor: d.color + '1f',
                        borderWidth: 2.5,
                        pointBackgroundColor: d.color,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: c => rupiahFull(c.parsed.y) } } },
                    scales: {
                        y: { beginAtZero: true, ticks: { callback: rupiahShort }, grid: { color: 'rgba(255,255,255,.06)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
        buildMainChart('daily');

        document.querySelectorAll('#periodTab .nav-link').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                document.querySelectorAll('#periodTab .nav-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                buildMainChart(link.dataset.period);
            });
        });
    </script>
</body>

</html>