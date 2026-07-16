<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customers</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php include "../component/sidebar.php"; ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Add Customer</h3>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php" class="text-decoration-none">Customer</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Add Customer</a>
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
                                <h3 class="card-title">Form Add Customer</h3>
                            </div>


                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Ref No</label>
                                        <input type="text" class="form-control" placeholder="Example : CUS-001">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Customer Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" class="form-control" placeholder="Example : 08...">
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

        <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>