<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="hold-transition layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php include "../itu diapain/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="app-content p-3">
                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Edit Item</h4>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a href="../dashboard/dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="Index.php">Item</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Edit Item</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Item</h3>
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="number" class="form-control" value="1">
                                </div>

                                <div class="form-group">
                                    <label>Ref No</label>
                                    <input type="text" class="form-control" value="ITM001">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="Laptop">
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" value="7500000">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a href="index.php" class="btn btn-warning">Update</a>
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
            </div>
            </section>
        </div>
        <footer class="app-footer">
            <strong>Copyright © 2026</strong>
        </footer>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>