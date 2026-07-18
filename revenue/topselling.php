<?php

$top_produk = [
    ['nama' => 'Laptop Asus VivoBook', 'terjual' => 42, 'omset' => 31500000, 'growth' => 12],
    ['nama' => 'Smartphone Samsung', 'terjual' => 35, 'omset' => 14000000, 'growth' => 8],
    ['nama' => 'Monitor LG 24 Inch', 'terjual' => 28, 'omset' => 5040000, 'growth' => -5],
    ['nama' => 'Printer Epson L3210', 'terjual' => 21, 'omset' => 4620000, 'growth' => 3],
    ['nama' => 'Gaming Headset', 'terjual' => 18, 'omset' => 630000, 'growth' => -10],
];

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Selling Products</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php
        $activePage = 'topselling';
        include "../component/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Top Selling</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Top Selling</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0">Top 5 Best-Selling Products</h6>
                        </div>
                        <div class="card-body py-2">
                            <table class="table align-middle mb-0" style="border-collapse:separate;border-spacing:0 10px">
                                <tbody>
                                    <?php foreach ($top_produk as $i => $p): ?>
                                        <?php
                                        $rankColor = match ($i) {
                                            0 => '#FFD700',
                                            1 => '#C0C0C0',
                                            2 => '#CD7F32',
                                            default => '#FFFFFF',
                                        };
                                        ?>
                                        <tr>
                                            <td class="p-0" style="width:30px">
                                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle fw-bold text-dark"
                                                    style="width:22px;height:22px;font-size:.75rem;background-color:<?= $rankColor ?>;border:1px solid rgba(0,0,0,.15)">
                                                    <?= $i + 1 ?>
                                                </span>
                                            </td>
                                            <td class="p-0">
                                                <div class="small fw-semibold"><?= $p['nama'] ?></div>
                                            </td>
                                            <td class="p-0 text-end">
                                                <span class="small text-muted ms-2"><?= $p['terjual'] ?> sold</span> <br>
                                                <small class="text-muted"><?= rupiah($p['omset']) ?></small>
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
        <?php include "../component/footer.php"; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>