<?php

$company = [
    [
        "id" => 1,
        "name" => "Araya Store",
        "entity" => "E-commerce",
        "email" => "Azura@gmail.com",
        "phone" => "081234567890",
        "country" => "Indonesia",
        "province" => "East Java",
        "city" => "Surabaya",
        "subdistrict" => "Sawahan",
        "address" => "Jl. Diponegoro, Surabaya",
        "signature_name" => "Azura Mishimoto",
        "contact_person" => "Azura Mishimoto",
        "tin" => "01.234.567.8-901.000",
        "website" => "www.arayastore.co.id",
    ],
];

$comp = $company[0];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Company</title>

    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">

    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>

        <?php
        $activePage = 'company';
        include "../itu diapain/sidebar.php";
        ?>

        <div class="content-wrapper">

            <div class="app-content p-3">

                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-sm-6">
                                <h3><?= htmlspecialchars($comp['name']); ?></h3>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Company
                                    </li>
                                </ol>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">

                    <!-- Company Information -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Company Information
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong>Company Name</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['name']); ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Business Entity</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['entity']); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong>Country</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['country']); ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Province</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['province']); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong>City / Regency</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['city']); ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Subdistrict</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['subdistrict']); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <strong>Company Email</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['email']); ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Company Phone Number</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['phone']); ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <strong>Business Address</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['address']); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="edit.php?id=<?= $comp['id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Change
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Right Side -->
                    <div class="col-md-5">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">
                                    Other Information
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="row mb-3">

                                    <div class="col-6">
                                        <strong>Contact Person</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['contact_person']); ?>
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <strong>TIN</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['tin']); ?>
                                        </p>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">
                                        <strong>Website</strong>
                                        <p class="mb-0">
                                            <?= htmlspecialchars($comp['website']); ?>
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- Logo and Document Signature -->
                        <div class="card mt-4">

                            <div class="card-header">
                                <h3 class="card-title">
                                    Logo and Document Signature
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <!-- Company Logo -->
                                    <div class="col-6">

                                        <label class="form-label">
                                            Company Logo (max 20MB)
                                        </label>

                                        <div
                                            class="border rounded d-flex flex-column align-items-center justify-content-center text-center text-muted p-4">

                                            <!-- <i class="bi bi-image fs-1 mb-2"></i> -->

                                            <span>No documents yet</span>

                                            <small>
                                                Maximum size 20MB (JPEG, PNG)
                                            </small>

                                        </div>

                                    </div>

                                    <!-- Signature -->
                                    <div class="col-6">

                                        <label class="form-label">
                                            Signature (max 20MB)
                                        </label>

                                        <div
                                            class="border rounded d-flex flex-column align-items-center justify-content-center text-center text-muted p-4">

                                            <!-- <i class="bi bi-pencil-square fs-1 mb-2"></i> -->

                                            <span>No documents yet</span>

                                            <small>
                                                Maximum size 20MB (JPEG, PNG)
                                            </small>

                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="mb-3">
                                    <strong>Name Appears on Signature</strong>

                                    <p class="mb-0">
                                        <?= htmlspecialchars($comp['signature_name']); ?>
                                    </p>
                                </div>

                                <!-- <div class="text-end">
                                    <a href="edit.php?id=
                                    <?= $comp['id']; ?>
                                    " class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Change
                                    </a>
                                </div> -->

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php include "../itu diapain/footer.php"; ?>

    </div>

    <script src="../dist/js/adminlte.min.js"></script>

</body>

</html>