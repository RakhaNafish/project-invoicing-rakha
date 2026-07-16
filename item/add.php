<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
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
                                <h3>Add Item</h3>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php" class="text-decoration-none">Item</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Add Item</a>
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
                                <h3 class="card-title">Form Add Item</h3>
                            </div>

                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Ref No</label>
                                        <input type="text" class="form-control" placeholder="Example : ITM001">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Item Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" placeholder="Price">
                                    </div>


                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="index.php" class="btn btn-primary float-right">Save</a>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
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