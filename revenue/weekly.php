<?php

// Dummy data - Weekly Revenue
$tahun_filter = isset($_GET['tahun']) ? (int) $_GET['tahun'] : (int) date('Y');
$minggu_filter = isset($_GET['minggu']) ? (int) $_GET['minggu'] : (int) date('W');

$data_mingguan = [
    ['hari' => 'Monday', 'jumlah_invoice' => 8, 'jumlah_item' => 24, 'omset' => 3850000],
    ['hari' => 'Tuesday', 'jumlah_invoice' => 12, 'jumlah_item' => 35, 'omset' => 5200000],
    ['hari' => 'Wednesday', 'jumlah_invoice' => 7, 'jumlah_item' => 18, 'omset' => 2950000],
    ['hari' => 'Thursday', 'jumlah_invoice' => 15, 'jumlah_item' => 48, 'omset' => 7800000],
    ['hari' => 'Friday', 'jumlah_invoice' => 20, 'jumlah_item' => 62, 'omset' => 9500000],
    ['hari' => 'Saturday', 'jumlah_invoice' => 18, 'jumlah_item' => 55, 'omset' => 8200000],
    ['hari' => 'Sunday', 'jumlah_invoice' => 10, 'jumlah_item' => 28, 'omset' => 4100000],
];

$total_omset = array_sum(array_column($data_mingguan, 'omset'));
$jumlah_invoice = array_sum(array_column($data_mingguan, 'jumlah_invoice'));
$total_item = array_sum(array_column($data_mingguan, 'jumlah_item'));
$rata_transaksi = $jumlah_invoice > 0 ? round($total_omset / $jumlah_invoice) : 0;

$chart_labels = array_column($data_mingguan, 'hari');
$chart_data = array_column($data_mingguan, 'omset');

// Year options
$tahun_list = range(date('Y') - 3, date('Y'));

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}

$perPage = 10;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $perPage;

$dataTampil = array_slice($data_mingguan, $start, $perPage);

$totalPage = ceil(count($data_mingguan) / $perPage);

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Revenue</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .summary-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .chart-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .table-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 16px;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php include "../itu diapain/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Weekly Revenue</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end mb-0">
                                    <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="revenue.php">Revenue</a></li>
                                    <li class="breadcrumb-item active">Weekly</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-end gap-2">
                                <button class="btn btn-outline-secondary" onclick="alert('Export PDF')">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                                </button>
                                <button class="btn btn-outline-secondary" onclick="alert('Export Excel')">
                                    <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3">

                    <!-- Filter -->
                    <div class="card summary-card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="bi bi-funnel me-2"></i>Filter</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label">Select Year</label>
                                    <select name="tahun" class="form-select">
                                        <?php foreach ($tahun_list as $t): ?>
                                            <option value="<?= $t ?>" <?= $t === $tahun_filter ? 'selected' : '' ?>><?= $t ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Select Week</label>
                                    <select name="minggu" class="form-select">
                                        <?php for ($w = 1; $w <= 53; $w++): ?>
                                            <option value="<?= $w ?>" <?= $w === $minggu_filter ? 'selected' : '' ?>>Week
                                                <?= $w ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search me-1"></i> Search
                                    </button>
                                    <a href="weekly.php" class="btn btn-secondary ms-1">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php if (count($data_mingguan) > 0): ?>

                        <!-- Summary Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="card summary-card text-white bg-success">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small opacity-75">Total Revenue</p>
                                            <h5 class="mb-0 fw-bold"><?= rupiah($total_omset) ?></h5>
                                        </div>
                                        <i class="bi bi-wallet2 fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="card summary-card text-white bg-primary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small opacity-75">Total Invoices</p>
                                            <h5 class="mb-0 fw-bold"><?= $jumlah_invoice ?> Invoice</h5>
                                        </div>
                                        <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="card summary-card text-white bg-warning">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small opacity-75">Total Items Sold</p>
                                            <h5 class="mb-0 fw-bold"><?= $total_item ?> Items</h5>
                                        </div>
                                        <i class="bi bi-cart3 fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="card summary-card text-white bg-danger">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small opacity-75">Average Transaction</p>
                                            <h5 class="mb-0 fw-bold"><?= rupiah($rata_transaksi) ?></h5>
                                        </div>
                                        <i class="bi bi-graph-up fs-1 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart -->
                        <div class="card chart-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="bi bi-bar-chart-line me-2"></i>Daily Revenue Chart
                                </h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartMingguan" height="100"></canvas>
                            </div>
                        </div>

                        <!-- Detail Table -->
                        <div class="card table-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0"><i class="bi bi-table me-2"></i>Daily Breakdown</h5>
                                <div class="d-flex gap-2 align-items-center">
                                    <label class="mb-0 small">Show</label>
                                    <select id="showEntries" class="form-select form-select-sm" style="width:auto">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                    </select>
                                    <label class="mb-0 small">entries</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-2 input-group">
                                    <span class="input-group-text">
                                    <i class="bi bi-search" aria-hidden="true"></i>
                                </span>
                                    <input type="text" id="searchInput" class="form-control form-control-sm"
                                        style="width:220px" placeholder="Search...">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelMingguan">
                                        <thead>
                                            <tr>
                                                <th class="sortable" data-col="0">Day</th>
                                                <th class="sortable text-center" data-col="1">Total Invoices</th>
                                                <th class="sortable text-center" data-col="2">Total Items</th>
                                                <th class="sortable text-end" data-col="3">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_mingguan as $row): ?>
                                                <tr>
                                                    <td><?= $row['hari'] ?></td>
                                                    <td class="text-center"><?= $row['jumlah_invoice'] ?></td>
                                                    <td class="text-center"><?= $row['jumlah_item'] ?></td>
                                                    <td class="text-end fw-semibold"><?= rupiah($row['omset']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-active fw-bold">
                                                <td>Total</td>
                                                <td class="text-center"><?= $jumlah_invoice ?></td>
                                                <td class="text-center"><?= $total_item ?></td>
                                                <td class="text-end"><?= rupiah($total_omset) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                            <ul class="pagination pagination-sm m-0">

                                <!-- Previous -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>">
                                        Previous
                                    </a>
                                </li>

                                <!-- Page 1 -->
                                <li class="page-item <?= ($page == 1) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=1">1</a>
                                </li>

                                <!-- Titik awal -->
                                <?php if ($page > 3): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>

                                <!-- Page sekitar current -->
                                <?php for ($i = max(2, $page - 1); $i <= min($totalPage - 1, $page + 1); $i++): ?>
                                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>">
                                            <?= $i ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Titik akhir -->
                                <?php if ($page < $totalPage - 2): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>

                                <!-- Last Page -->
                                <?php if ($totalPage > 1): ?>
                                    <li class="page-item <?= ($page == $totalPage) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $totalPage ?>">
                                            <?= $totalPage ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- Next -->
                                <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>">
                                        Next
                                    </a>
                                </li>
                            </ul>
                        </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="card">
                            <div class="card-body empty-state">
                                <i class="bi bi-inbox d-block"></i>
                                <p class="mb-0">No sales data found for this period.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <?php include "../itu diapain/footer.php"; ?>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const ctx = document.getElementById('chartMingguan');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($chart_labels) ?>,
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: <?= json_encode($chart_data) ?>,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,.15)',
                        borderWidth: 2,
                        pointBackgroundColor: '#0d6efd',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { callback: v => 'Rp ' + (v / 1000000).toFixed(1) + 'M' }
                        }
                    }
                }
            });
        }

        (function () {
            const table = document.getElementById('tabelMingguan');
            if (!table) return;
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const searchEl = document.getElementById('searchInput');
            const showEl = document.getElementById('showEntries');
            const pageCtrl = document.getElementById('paginationControls');
            const pageTxt = document.getElementById('paginationText');
            let sortCol = -1, sortAsc = true, currentPage = 1;

            function filterRows() {
                const q = searchEl.value.toLowerCase();
                return allRows.filter(r => r.textContent.toLowerCase().includes(q));
            }
            function sortRows(rows) {
                if (sortCol < 0) return rows;
                return [...rows].sort((a, b) => {
                    const av = a.cells[sortCol]?.textContent.trim() || '';
                    const bv = b.cells[sortCol]?.textContent.trim() || '';
                    const an = parseFloat(av.replace(/[^\d]/g, ''));
                    const bn = parseFloat(bv.replace(/[^\d]/g, ''));
                    const cmp = !isNaN(an) && !isNaN(bn) ? an - bn : av.localeCompare(bv, 'id');
                    return sortAsc ? cmp : -cmp;
                });
            }
            function render() {
                const filtered = sortRows(filterRows());
                const perPage = parseInt(showEl.value);
                const total = filtered.length;
                const pages = Math.max(1, Math.ceil(total / perPage));
                currentPage = Math.min(currentPage, pages);
                const start = (currentPage - 1) * perPage;
                allRows.forEach(r => { r.style.display = 'none'; });
                filtered.slice(start, start + perPage).forEach(r => { r.style.display = ''; });
                pageTxt.textContent = total === 0
                    ? 'No data found'
                    : `Showing ${start + 1}–${Math.min(start + perPage, total)} of ${total} entries`;
                pageCtrl.innerHTML = '';
                for (let p = 1; p <= pages; p++) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (p === currentPage ? ' active' : '');
                    li.innerHTML = `<a class="page-link" href="#">${p}</a>`;
                    li.addEventListener('click', e => { e.preventDefault(); currentPage = p; render(); });
                    pageCtrl.appendChild(li);
                }
            }
            searchEl.addEventListener('input', () => { currentPage = 1; render(); });
            showEl.addEventListener('change', () => { currentPage = 1; render(); });
            table.querySelectorAll('th.sortable').forEach(th => {
                th.style.cursor = 'pointer';
                th.addEventListener('click', () => {
                    const col = parseInt(th.dataset.col);
                    if (sortCol === col) sortAsc = !sortAsc; else { sortCol = col; sortAsc = true; }
                    render();
                });
            });
            render();
        })();
    </script>
</body>

</html>