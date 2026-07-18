<?php
$from = isset($_GET['from']) && $_GET['from'] === 'table' ? 'table' : 'invoice';
$backUrl = $from === 'table' ? 'table.invoice.php' : 'invoice.php';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="hold-transition layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php include "../component/sidebar.php"; ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Edit Invoice</h4>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?= $backUrl ?>" class="text-decoration-none">Invoice</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Edit Invoice</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <section>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Invoice</h3>
                            </div>

                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Invoice No</label>
                                        <input type="text" class="form-control" placeholder="Insert Invoice No">
                                    </div>

                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select class="form-select">
                                            <option>-- Select Customer --</option>
                                            <option selected>Andi Pratama</option>
                                            <option>Budi Santoso</option>
                                            <option>Dewi Lestari</option>
                                            <option>Eko Saputra</option>
                                            <option>Farhan Akbar</option>
                                            <option>Gita Permata</option>
                                            <option>Hendra Wijaya</option>
                                            <option>Indah Sari</option>
                                            <option>Joko Susilo</option>
                                            <option>Kartika Putri</option>
                                            <option>Lukman Hakim</option>
                                            <option>Maya Sari</option>
                                            <option>Nanda Putra</option>
                                            <option>Olivia Putri</option>
                                            <option>Putra Nugraha</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Issue_date</label>
                                        <input type="date" class="form-control" placeholder="Insert Issue_date">
                                    </div>
                                    <div class="form-group">
                                        <label>Due_Date</label>
                                        <input type="date" class="form-control" placeholder="Insert Due_Date">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control">
                                            <option>Paid</option>
                                            <option>Unpaid</option>
                                            <option>Pending</option>
                                        </select>
                                    </div> -->
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="<?= $backUrl ?>" class="btn btn-warning">Update</a>
                                <a href="<?= $backUrl ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                </div>
                </section>
            </div>
        </div>
        <?php include "../component/footer.php"; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>