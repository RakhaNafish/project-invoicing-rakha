<?php

$items = [

    ["id" => 1, "ref_no" => "ITM001", "name" => "Laptop Asus VivoBook", "price" => 7500000],
    ["id" => 2, "ref_no" => "ITM002", "name" => "Mouse Logitech Wireless", "price" => 150000],
    ["id" => 3, "ref_no" => "ITM003", "name" => "Keyboard Mechanical", "price" => 450000],
    ["id" => 4, "ref_no" => "ITM004", "name" => "Monitor LG 24 Inch", "price" => 1800000],
    ["id" => 5, "ref_no" => "ITM005", "name" => "Headset Gaming", "price" => 350000],
    ["id" => 6, "ref_no" => "ITM006", "name" => "Webcam Full HD", "price" => 500000],
    ["id" => 7, "ref_no" => "ITM007", "name" => "Printer Epson L3210", "price" => 2200000],
    ["id" => 8, "ref_no" => "ITM008", "name" => "Flashdisk 64GB", "price" => 90000],
    ["id" => 9, "ref_no" => "ITM009", "name" => "Harddisk External 1TB", "price" => 800000],
    ["id" => 10, "ref_no" => "ITM010", "name" => "SSD 512GB", "price" => 650000],

    ["id" => 11, "ref_no" => "ITM011", "name" => "RAM 16GB DDR4", "price" => 700000],
    ["id" => 12, "ref_no" => "ITM012", "name" => "Kabel HDMI", "price" => 75000],
    ["id" => 13, "ref_no" => "ITM013", "name" => "Charger Laptop", "price" => 400000],
    ["id" => 14, "ref_no" => "ITM014", "name" => "Cooling Fan Laptop", "price" => 250000],
    ["id" => 15, "ref_no" => "ITM015", "name" => "Speaker Bluetooth", "price" => 300000],
    ["id" => 16, "ref_no" => "ITM016", "name" => "Kamera Digital", "price" => 3500000],
    ["id" => 17, "ref_no" => "ITM017", "name" => "Tablet Android", "price" => 2500000],
    ["id" => 18, "ref_no" => "ITM018", "name" => "Smartphone Samsung", "price" => 4000000],
    ["id" => 19, "ref_no" => "ITM019", "name" => "Power Bank 20000mAh", "price" => 250000],
    ["id" => 20, "ref_no" => "ITM020", "name" => "Smartwatch", "price" => 900000],

    ["id" => 21, "ref_no" => "ITM021", "name" => "Router WiFi", "price" => 450000],
    ["id" => 22, "ref_no" => "ITM022", "name" => "LAN Cable 10M", "price" => 50000],
    ["id" => 23, "ref_no" => "ITM023", "name" => "Microphone USB", "price" => 275000],
    ["id" => 24, "ref_no" => "ITM024", "name" => "Projector Epson", "price" => 5200000],
    ["id" => 25, "ref_no" => "ITM025", "name" => "UPS 650VA", "price" => 850000],
    ["id" => 26, "ref_no" => "ITM026", "name" => "Graphic Tablet", "price" => 1200000],
    ["id" => 27, "ref_no" => "ITM027", "name" => "USB Hub 4 Port", "price" => 95000],
    ["id" => 28, "ref_no" => "ITM028", "name" => "Card Reader", "price" => 45000],
    ["id" => 29, "ref_no" => "ITM029", "name" => "Scanner Canon", "price" => 1700000],
    ["id" => 30, "ref_no" => "ITM030", "name" => "Mini PC", "price" => 4800000]

];

$perPage = 10;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $perPage;

$dataTampil = array_slice($items, $start, $perPage);

$totalPage = ceil(count($items) / $perPage);

?>



<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Item</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">


        <?php include "../itu diapain/header.php"; ?>
        <?php
        $activePage = 'item';
        include "../itu diapain/sidebar.php";
        ?>

        <!-- Main Content -->

        <div class="content-wrapper">
            <div class="app-content p-3">

                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3> Data Item</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Item</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <div class="input-group input-group-sm" style="max-width:250px;">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input id="searchInput" type="search" class="form-control"
                                    placeholder="Search Customer">
                            </div>

                            <a href="tambah.php" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Add Item
                            </a>

                        </div>
                    </div>

                    <div class="card-body">
                        <table id="itemTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Ref No</th>
                                    <th>Name</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($dataTampil as $item): ?>
                                    <tr>
                                        <td class="text-center"><?= $item['id']; ?></td>
                                        <td class="text-center"><?= $item['ref_no']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td class="text-end">Rp <?= number_format($item['price']); ?></td>
                                        <td class="text-center">
                                            <a href="edit.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>
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

        <?php include "../itu diapain/footer.php"; ?>

    </div>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {

            let keyword = this.value.toLowerCase();

            let rows = document.querySelectorAll('#itemTable tbody tr');

            rows.forEach(function (row) {

                let text = row.textContent.toLowerCase();

                if (text.indexOf(keyword) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            });

        });
    </script>
</body>

</html>