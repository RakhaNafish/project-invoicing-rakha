<?php

$company = [
    [
        "id" => 1,
        "name" => "Xonada",
        "entity" => "E-commerce",
        "email" => "Azura@gmail.com",
        "phone" => "081234567890",
        "country" => "Indonesia",
        "province" => "East Java",
        "city" => "Surabaya",
        "subdistrict" => "Sawahan",
        "address" => "Jl. Diponegro, Surabaya",
        "logo" => null,
        "signature" => null,
        "signature_name" => "Azura Mishimoto",
        "contact_person" => "Azura Mishimoto",
        "tin" => "01.234.567.8-901.000",
        "website" => "www.Xonada.co.id",
    ],
];

$comp = $company[0];

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
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
                                <h4>Edit Company</h4>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item active">
                                        <a href="../dashboard/dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Company</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Edit Company</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <form method="POST" action="#">
                        <input type="hidden" name="id" value="<?= $comp['id']; ?>">

                        <!-- Info Perusahaan -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Company Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Company Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($comp['name']); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Business Entity</label>
                                        <select name="entity" class="form-select">
                                            <?php foreach (['PT', 'CV', 'UD', 'Firma', 'Koperasi'] as $ent): ?>
                                            <option value="<?= $ent; ?>" <?= $comp['entity'] === $ent ? 'selected' : ''; ?>><?= $ent; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($comp['country']); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Province</label>
                                        <input type="text" name="province" class="form-control" value="<?= htmlspecialchars($comp['province']); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>City/Regency</label>
                                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($comp['city']); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Subdistrict</label>
                                        <input type="text" name="subdistrict" class="form-control" value="<?= htmlspecialchars($comp['subdistrict']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Business Address</label>
                                    <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($comp['address']); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Logo & Tanda Tangan -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Logo and Document Signature</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Company Logo (max 20MB)</label>
                                        <input type="file" name="logo" class="form-control" accept="image/jpeg,image/png">
                                        <?php if ($comp['logo']): ?>
                                        <small class="text-muted">Current: <?= htmlspecialchars($comp['logo']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Signature (max 20MB)</label>
                                        <input type="file" name="signature" class="form-control" accept="image/jpeg,image/png">
                                        <?php if ($comp['signature']): ?>
                                        <small class="text-muted">Current: <?= htmlspecialchars($comp['signature']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name appears on Signature</label>
                                    <input type="text" name="signature_name" class="form-control" value="<?= htmlspecialchars($comp['signature_name']); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Company Contact Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Company Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($comp['email']); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Company Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($comp['phone']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lainnya -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Other Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" value="<?= htmlspecialchars($comp['contact_person']); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>TIN</label>
                                        <input type="text" name="tin" class="form-control" value="<?= htmlspecialchars($comp['tin']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" value="<?= htmlspecialchars($comp['website']); ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="index.php" class="btn btn-secondary">Back</a>
                            </div>
                        </div>

                    </form>
                </section>
            </div>
        </div>
        <footer class="app-footer">
            <strong>Copyright © 2026</strong>
        </footer>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>