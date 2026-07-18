<?php

$date_filter = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$invoices_harian = [
    ['daily' => 'Sunday, 21', 'total_invoice' => 10, 'item_amount' => 3, 'total' => 1250000],
    ['daily' => 'Monday, 22', 'total_invoice' => 10, 'item_amount' => 1, 'total' => 450000],
    ['daily' => 'Tuesday, 23', 'total_invoice' => 10, 'item_amount' => 5, 'total' => 3200000],
    ['daily' => 'Wednesday, 24', 'total_invoice' => 10, 'item_amount' => 2, 'total' => 900000],
    ['daily' => 'Thursday, 25', 'total_invoice' => 10, 'item_amount' => 4, 'total' => 2100000],
    ['daily' => 'Friday, 26', 'total_invoice' => 10, 'item_amount' => 2, 'total' => 750000],
    ['daily' => 'Saturday, 27', 'total_invoice' => 10, 'item_amount' => 6, 'total' => 4800000]
];

$data_mingguan = [
    ['mingguan' => 'Week 1 (July)', 'jumlah_invoice' => 8, 'jumlah_item' => 24, 'omset' => 3850000],
    ['mingguan' => 'Week 2 (July)', 'jumlah_invoice' => 12, 'jumlah_item' => 35, 'omset' => 5200000],
    ['mingguan' => 'Week 3 (July)', 'jumlah_invoice' => 7, 'jumlah_item' => 18, 'omset' => 2950000],
    ['mingguan' => 'Week 4 (July)', 'jumlah_invoice' => 15, 'jumlah_item' => 48, 'omset' => 7800000],
];

$data_bulanan = [
    ['tanggal_label' => 'January', 'jumlah_invoice' => 52, 'jumlah_item' => 180, 'omset' => 18500000],
    ['tanggal_label' => 'February', 'jumlah_invoice' => 61, 'jumlah_item' => 210, 'omset' => 22300000],
    ['tanggal_label' => 'March', 'jumlah_invoice' => 58, 'jumlah_item' => 201, 'omset' => 20700000],
    ['tanggal_label' => 'April', 'jumlah_invoice' => 58, 'jumlah_item' => 201, 'omset' => 20700000],
    ['tanggal_label' => 'May', 'jumlah_invoice' => 58, 'jumlah_item' => 201, 'omset' => 20700000],
    ['tanggal_label' => 'June', 'jumlah_invoice' => 67, 'jumlah_item' => 240, 'omset' => 25400000]
];

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}

$perPage = 10;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $perPage;

$dataTampil = array_slice($invoices_harian, $start, $perPage);

$totalPage = ceil(count($invoices_harian) / $perPage);

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Invoice</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"> -->

</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php
        $activePage = 'revenue';
        include "../component/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Revenue</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Revenue</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h6 class="card-title mb-0">Revenue Table</h6>

                            <div class="btn-group" role="group">
                                <button class="btn btn-primary active period-btn" data-period="daily">
                                    Daily
                                </button>

                                <button class="btn btn-outline-primary period-btn" data-period="weekly">
                                    Weekly
                                </button>

                                <button class="btn btn-outline-primary period-btn" data-period="monthly">
                                    Monthly
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <div id="table-daily">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelHarian">
                                        <thead>
                                            <tr>
                                                <th class="sortable" data-col="0">Day</th>
                                                <th class="sortable text-center" data-col="1">Total Invoice </th>
                                                <th class="sortable text-center" data-col="2">Total Item</th>
                                                <th class="sortable text-end" data-col="3">Total Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($invoices_harian as $inv): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($inv['daily']) ?></td>
                                                    <td class="text-center"><?= $inv['total_invoice'] ?></td>
                                                    <td class="text-center"><?= $inv['item_amount'] ?></td>
                                                    <td class="text-end fw-semibold"><?= rupiah($inv['total']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="table-weekly" class="d-none">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelMingguan">
                                        <thead>
                                            <tr>
                                                <th class="sortable" data-col="0">Week</th>
                                                <th class="sortable text-center" data-col="1">Total Invoices</th>
                                                <th class="sortable text-center" data-col="2">Total Items</th>
                                                <th class="sortable text-end" data-col="3">Total Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_mingguan as $row): ?>
                                                <tr>
                                                    <td><?= $row['mingguan'] ?></td>
                                                    <td class="text-center"><?= $row['jumlah_invoice'] ?></td>
                                                    <td class="text-center"><?= $row['jumlah_item'] ?></td>
                                                    <td class="text-end fw-semibold"><?= rupiah($row['omset']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="table-monthly" class="d-none">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelBulanan">
                                        <thead>
                                            <tr>
                                                <th class="sortable" data-col="0">Month</th>
                                                <th class="sortable text-center" data-col="1">Total Invoices</th>
                                                <th class="sortable text-center" data-col="2">Total Items</th>
                                                <th class="sortable text-end" data-col="3">Total Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_bulanan as $row): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['tanggal_label']) ?></td>
                                                    <td class="text-center"><?= $row['jumlah_invoice'] ?></td>
                                                    <td class="text-center"><?= $row['jumlah_item'] ?></td>
                                                    <td class="text-end fw-semibold"><?= rupiah($row['omset']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

                </div>
            </div>

        </div>
        <?php include "../component/footer.php"; ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const buttons = document.querySelectorAll(".period-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function () {

                // Reset button
                buttons.forEach(btn => {
                    btn.classList.remove("active", "btn-primary");
                    btn.classList.add("btn-outline-primary");
                });

                this.classList.add("active", "btn-primary");
                this.classList.remove("btn-outline-primary");

                // Sembunyikan semua tabel
                document.getElementById("table-daily").classList.add("d-none");
                document.getElementById("table-weekly").classList.add("d-none");
                document.getElementById("table-monthly").classList.add("d-none");

                // Tampilkan tabel sesuai pilihan
                document.getElementById(`table-${this.dataset.period}`).classList.remove("d-none");
            });
        });
    </script>
</body>

</html>