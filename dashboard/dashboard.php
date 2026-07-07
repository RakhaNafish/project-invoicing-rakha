<?php

// ============================
// DUMMY DATA - Revenue Dashboard
// ============================

$tahun_aktif = (int) date('Y');
$bulan_aktif = (int) date('n');
$tanggal_aktif = date('Y-m-d');

$bulan_nama = [
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'May',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Aug',
    9 => 'Sep',
    10 => 'Oct',
    11 => 'Nov',
    12 => 'Dec'
];
$bulan_nama_full = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
];

// ── Daily (today per hour) ──────────────────────────────
$omset_harian_total = 25500000;
$invoice_harian = 13;
$item_harian = 41;
$omset_harian_jam = [1250000, 450000, 3200000, 900000, 2100000, 750000, 4800000, 300000, 1500000, 2250000, 5600000, 450000, 1900000];
$jam_labels = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

// ── Weekly (this week per day) ────────────────────────
$omset_mingguan_total = 41600000;
$invoice_mingguan = 90;
$item_mingguan = 270;
$omset_per_hari = [3850000, 5200000, 2950000, 7800000, 9500000, 8200000, 4100000];
$hari_labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// ── Monthly (this month per date) ──────────────────────
$omset_bulanan_total = 68900000;
$invoice_bulanan = 195;
$item_bulanan = 587;
$omset_per_tanggal = [
    850000,
    1200000,
    950000,
    2100000,
    // 1800000,
    // 3200000,
    // 2750000,
    // 1100000,
    // 1400000,
    // 980000,
    // 2300000,
    // 1950000,
    // 2800000,
    // 3100000,
    // 900000,
    // 1600000,
    // 2050000,
    // 1750000,
    // 2900000,
    // 3400000,
    // 2200000,
    // 1300000,
    // 1500000,
    // 2600000,
    // 1850000,
    // 3050000,
    // 2400000,
    // 1700000,
    // 2100000,
    2800000
];
$bulan_labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];

// ── Last 12 months (for main line chart) ────────────
$omset_12bulan = [42000000, 38000000, 55000000, 49000000, 61000000, 58000000, 72000000, 65000000, 70000000, 63000000, 75000000, 68900000];
$label_12bulan = [];
for ($i = 11; $i >= 0; $i--) {
    $m = $bulan_aktif - $i;
    $y = $tahun_aktif;
    if ($m <= 0) {
        $m += 12;
        $y--;
    }
    $label_12bulan[] = $bulan_nama[$m] . ' ' . $y;
}

// ── Top 5 best-selling products ─────────────────────────
$top_produk = [
    ['nama' => 'Laptop Asus VivoBook', 'terjual' => 42, 'omset' => 31500000, 'pct' => 46],
    ['nama' => 'Smartphone Samsung', 'terjual' => 35, 'omset' => 14000000, 'pct' => 38],
    ['nama' => 'Monitor LG 24 Inch', 'terjual' => 28, 'omset' => 5040000, 'pct' => 30],
    ['nama' => 'Printer Epson L3210', 'terjual' => 21, 'omset' => 4620000, 'pct' => 23],
    ['nama' => 'Gaming Headset', 'terjual' => 18, 'omset' => 630000, 'pct' => 19],
];

// ── Recent transactions ─────────────────────────────────
$transaksi_terbaru = [
    ['no' => 'INV-013', 'customer' => 'Teguh Wibowo', 'total' => 1900000, 'waktu' => '20:00', 'status' => 'Pending'],
    ['no' => 'INV-012', 'customer' => 'Laila Sari', 'total' => 450000, 'waktu' => '19:10', 'status' => 'Paid'],
    ['no' => 'INV-011', 'customer' => 'Fajar Nugroho', 'total' => 5600000, 'waktu' => '18:20', 'status' => 'Paid'],
    ['no' => 'INV-010', 'customer' => 'Maya Anggraini', 'total' => 2250000, 'waktu' => '17:00', 'status' => 'Paid'],
    ['no' => 'INV-009', 'customer' => 'Doni Setiawan', 'total' => 1500000, 'waktu' => '16:45', 'status' => 'Paid'],
    ['no' => 'INV-008', 'customer' => 'Rina Kusuma', 'total' => 300000, 'waktu' => '15:10', 'status' => 'Pending'],
    ['no' => 'INV-007', 'customer' => 'Hendra Wijaya', 'total' => 4800000, 'waktu' => '14:30', 'status' => 'Paid'],
];

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}
function persen_naik(int $a, int $b): string
{
    // a = current, b = previous
    if ($b === 0)
        return '+0%';
    $p = round(($a - $b) / $b * 100, 1);
    return ($p >= 0 ? '+' : '') . $p . '%';
}

// Growth badges (vs previous period - dummy)
$growth_harian = persen_naik(25500000, 21000000);
$growth_mingguan = persen_naik(41600000, 38200000);
$growth_bulanan = persen_naik(68900000, 63000000);

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
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .18);
            transition: transform .15s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .chart-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .18);
        }

        .growth-badge {
            font-size: .75rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .growth-up {
            background: rgba(25, 135, 84, .2);
            color: #1cbb78;
        }

        .growth-down {
            background: rgba(220, 53, 69, .2);
            color: #e35d6a;
        }

        .progress-bar-anim {
            transition: width .6s ease;
        }

        .top-product-row {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        .top-product-row:last-child {
            border-bottom: none;
        }

        .period-tab .nav-link {
            border-radius: 6px;
            font-size: .85rem;
            padding: 4px 14px;
        }

        .period-tab .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .mini-chart-wrap {
            position: relative;
            height: 70px;
        }

        @media (max-width: 767.98px) {
            .content-header h3 {
                font-size: 1.25rem;
            }

            .content-header .row.mt-2 .col-12 {
                justify-content: center !important;
                flex-wrap: wrap;
            }

            .card-header {
                flex-wrap: wrap;
                gap: 8px;
            }

            .period-tab {
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            #mainChart {
                min-height: 220px;
            }

            .top-product-row .small {
                font-size: .75rem;
            }
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php 
        $activePage = 'dashboard';
        include "../itu diapain/sidebar.php"; 
        ?>

        <div class="content-wrapper">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Dashboard</h3>
                                <small class="text-muted">
                                    <?= date('l, d') ?> <?= $bulan_nama_full[$bulan_aktif] ?> <?= $tahun_aktif ?>
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end mb-0">
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-end gap-2">
                                <a href="../revenue/daily.php" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-calendar-day me-1"></i>Daily</a>
                                <a href="../revenue/weekly.php" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-calendar-week me-1"></i>Weekly</a>
                                <a href="../revenue/monthly.php" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-calendar-month me-1"></i>Monthly</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3">

                    <!-- ══ ROW 1: 3 Stat Cards ══════════════════════════════════ -->
                    <div class="row g-3 mb-4">

                        <!-- Daily -->
                        <div class="col-12 col-md-4">
                            <div class="card stat-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Today's Revenue
                                            </p>
                                            <h4 class="mb-0 fw-bold"><?= rupiah($omset_harian_total) ?></h4>
                                        </div>
                                        <span class="p-2 rounded bg-success bg-opacity-25">
                                            <i class="bi bi-sun fs-4 text-success"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="growth-badge growth-up"><?= $growth_harian ?></span>
                                        <small class="text-muted">vs yesterday</small>
                                    </div>
                                    <div class="row text-center g-0 border-top pt-2">
                                        <div class="col border-end">
                                            <div class="fw-semibold"><?= $invoice_harian ?></div>
                                            <small class="text-muted">Invoice</small>
                                        </div>
                                        <div class="col">
                                            <div class="fw-semibold"><?= $item_harian ?></div>
                                            <small class="text-muted">Items</small>
                                        </div>
                                    </div>
                                    <div class="mini-chart-wrap mt-3">
                                        <canvas id="miniChartHarian"></canvas>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <a href="../revenue/daily.php" class="btn btn-sm btn-outline-success">
                                            Detail <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weekly -->
                        <div class="col-12 col-md-4">
                            <div class="card stat-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-muted mb-1 small text-uppercase fw-semibold">This Week's
                                                Revenue
                                            </p>
                                            <h4 class="mb-0 fw-bold"><?= rupiah($omset_mingguan_total) ?></h4>
                                        </div>
                                        <span class="p-2 rounded bg-primary bg-opacity-25">
                                            <i class="bi bi-calendar-week fs-4 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="growth-badge growth-up"><?= $growth_mingguan ?></span>
                                        <small class="text-muted">vs last week</small>
                                    </div>
                                    <div class="row text-center g-0 border-top pt-2">
                                        <div class="col border-end">
                                            <div class="fw-semibold"><?= $invoice_mingguan ?></div>
                                            <small class="text-muted">Invoice</small>
                                        </div>
                                        <div class="col">
                                            <div class="fw-semibold"><?= $item_mingguan ?></div>
                                            <small class="text-muted">Items</small>
                                        </div>
                                    </div>
                                    <div class="mini-chart-wrap mt-3">
                                        <canvas id="miniChartMingguan"></canvas>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <a href="../revenue/weekly.php" class="btn btn-sm btn-outline-primary">
                                            Detail <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Monthly -->
                        <div class="col-12 col-md-4">
                            <div class="card stat-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-muted mb-1 small text-uppercase fw-semibold">
                                                <?= $bulan_nama_full[$bulan_aktif] ?> Revenue
                                            </p>
                                            <h4 class="mb-0 fw-bold"><?= rupiah($omset_bulanan_total) ?></h4>
                                        </div>
                                        <span class="p-2 rounded bg-danger bg-opacity-25">
                                            <i class="bi bi-calendar-month fs-4 text-danger"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="growth-badge growth-up"><?= $growth_bulanan ?></span>
                                        <small class="text-muted">vs last month</small>
                                    </div>
                                    <div class="row text-center g-0 border-top pt-2">
                                        <div class="col border-end">
                                            <div class="fw-semibold"><?= $invoice_bulanan ?></div>
                                            <small class="text-muted">Invoice</small>
                                        </div>
                                        <div class="col">
                                            <div class="fw-semibold"><?= $item_bulanan ?></div>
                                            <small class="text-muted">Items</small>
                                        </div>
                                    </div>
                                    <div class="mini-chart-wrap mt-3">
                                        <canvas id="miniChartBulanan"></canvas>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <a href="../revenue/monthly.php" class="btn btn-sm btn-outline-danger">
                                            Detail <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ══ ROW 2: Main Chart + Top Products ═══════════════════════ -->
                    <div class="row g-3 mb-4">

                        <!-- Main chart 12 months -->
                        <div class="col-12 col-xl-8">
                            <div class="card chart-card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-graph-up me-2 text-primary"></i>12-Month Revenue Trend
                                    </h6>
                                    <!-- Period switcher -->
                                    <ul class="nav period-tab gap-1" id="periodTab">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#" data-period="harian">Daily</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-period="mingguan">Weekly</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-period="bulanan">Monthly</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <canvas id="mainChart" height="110"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Top 5 products -->
                        <div class="col-12 col-xl-4">
                            <div class="card chart-card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-trophy me-2 text-warning"></i>Top 5 Best-Selling Products
                                    </h6>
                                </div>
                                <div class="card-body py-2">
                                    <?php foreach ($top_produk as $i => $p): ?>
                                        <div class="top-product-row">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge rounded-pill text-bg-secondary"
                                                        style="width:22px;height:22px;line-height:14px;text-align:center">
                                                        <?= $i + 1 ?>
                                                    </span>
                                                    <span class="small fw-semibold"><?= $p['nama'] ?></span>
                                                </div>
                                                <span class="small text-muted"><?= $p['terjual'] ?> sold</span>
                                            </div>
                                            <div class="progress" style="height:5px">
                                                <div class="progress-bar progress-bar-anim bg-<?= ['warning', 'primary', 'success', 'info', 'danger'][$i] ?>"
                                                    style="width:<?= $p['pct'] ?>%"></div>
                                            </div>
                                            <div class="text-end mt-1">
                                                <small class="text-muted"><?= rupiah($p['omset']) ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ══ ROW 3: Donut Chart + Recent Transactions ═══════════════════ -->
                    <div class="row g-3 mb-4">

                        <!-- Donut: period distribution -->
                        <div class="col-12 col-md-5 col-xl-4">
                            <div class="card chart-card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-pie-chart me-2 text-info"></i>Period Distribution
                                    </h6>
                                </div>
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                    <canvas id="donutChart" style="max-height:220px;max-width:220px"></canvas>
                                    <div class="mt-3 w-100">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span><span class="me-2" style="color:#198754">●</span>Today</span>
                                            <span><?= rupiah($omset_harian_total) ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span><span class="me-2" style="color:#0d6efd">●</span>This Week</span>
                                            <span><?= rupiah($omset_mingguan_total) ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between small">
                                            <span><span class="me-2"
                                                    style="color:#dc3545">●</span><?= $bulan_nama_full[$bulan_aktif] ?></span>
                                            <span><?= rupiah($omset_bulanan_total) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent transactions table -->
                        <div class="col-12 col-md-7 col-xl-8">
                            <div class="card chart-card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-clock-history me-2 text-secondary"></i>Today's Recent
                                        Transactions
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Invoice</th>
                                                    <th>Customer</th>
                                                    <th>Time</th>
                                                    <th class="text-end">Total</th>
                                                    <th class="text-center pe-3">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($transaksi_terbaru as $transaction): ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <span><?= $transaction['no'] ?></span>
                                                        </td>
                                                        <td><?= htmlspecialchars($transaction['customer']) ?></td>
                                                        <td><small class="text-muted"><?= $transaction['waktu'] ?></small>
                                                        </td>
                                                        <td class="text-end fw-semibold">
                                                            <?= rupiah($transaction['total']) ?></td>
                                                        <td class="text-center pe-3">
                                                            <span
                                                                class="badge <?= $transaction['status'] === 'Paid' ? 'text-bg-success' : 'text-bg-warning' ?>">
                                                                <?= $transaction['status'] ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
        // ── Data from PHP ────────────────────────────────────────
        const DATA = {
            harian: {
                labels: <?= json_encode($jam_labels) ?>,
                values: <?= json_encode($omset_harian_jam) ?>,
                color: '#198754'
            },
            mingguan: {
                labels: <?= json_encode($hari_labels) ?>,
                values: <?= json_encode($omset_per_hari) ?>,
                color: '#0d6efd'
            },
            bulanan: {
                labels: <?= json_encode($bulan_labels) ?>,
                values: <?= json_encode($omset_per_tanggal) ?>,
                color: '#dc3545'
            }
        };
        const DATA_12BULAN = {
            labels: <?= json_encode($label_12bulan) ?>,
            values: <?= json_encode($omset_12bulan) ?>
        };

        // ── Helper ───────────────────────────────────────────────
        function rupiahShort(v) {
            if (v >= 1e9) return 'Rp ' + (v / 1e9).toFixed(1) + 'B';
            if (v >= 1e6) return 'Rp ' + (v / 1e6).toFixed(1) + 'M';
            return 'Rp ' + (v / 1e3).toFixed(0) + 'K';
        }
        function rupiahFull(v) {
            return 'Rp ' + v.toLocaleString('id-ID');
        }

        const chartDefaults = {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: c => rupiahFull(c.parsed.y) } } },
            scales: { y: { beginAtZero: true, ticks: { callback: rupiahShort } } }
        };

        // ── Mini chart builder ───────────────────────────────────
        function buildMini(id, labels, data, color) {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{ data, backgroundColor: color + '99', borderRadius: 3 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: c => rupiahFull(c.parsed.y) } } },
                    scales: { x: { display: false }, y: { display: false, beginAtZero: true } }
                }
            });
        }

        buildMini('miniChartHarian', DATA.harian.labels, DATA.harian.values, '#198754');
        buildMini('miniChartMingguan', DATA.mingguan.labels, DATA.mingguan.values, '#0d6efd');
        buildMini('miniChartBulanan', DATA.bulanan.labels, DATA.bulanan.values, '#dc3545');

        // ── Main chart ───────────────────────────────────────────
        let mainChart = null;
        function buildMainChart(period) {
            const ctx = document.getElementById('mainChart');
            if (!ctx) return;
            if (mainChart) mainChart.destroy();
            const d = period === 'bulanan'
                ? { labels: DATA_12BULAN.labels, values: DATA_12BULAN.values, color: '#dc3545' }
                : DATA[period];
            mainChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: d.labels,
                    datasets: [{
                        label: 'Revenue',
                        data: d.values,
                        borderColor: d.color,
                        backgroundColor: d.color + '22',
                        borderWidth: 2.5,
                        pointBackgroundColor: d.color,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { ...chartDefaults }
            });
        }
        buildMainChart('harian');

        // Period tab switcher
        document.querySelectorAll('#periodTab .nav-link').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                document.querySelectorAll('#periodTab .nav-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                buildMainChart(link.dataset.period);
            });
        });

        // ── Donut chart ──────────────────────────────────────────
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Today', 'This Week', '<?= $bulan_nama_full[$bulan_aktif] ?>'],
                datasets: [{
                    data: [<?= $omset_harian_total ?>, <?= $omset_mingguan_total ?>, <?= $omset_bulanan_total ?>],
                    backgroundColor: ['#198754', '#0d6efd', '#dc3545'],
                    borderWidth: 2,
                    hoverOffset: 6
                }]
            },
            options: {
                cutout: '72%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: c => rupiahFull(c.parsed) } }
                }
            }
        });
    </script>
</body>

</html>