<?php

$company = [
    [
        "id" => 1,
        "name" => "Araya Store",
        "entity" => "E-commerce",
        "email" => "azura@gmail.com",
        "phone" => "081234567890",
        "country" => "Indonesia",
        "province" => "East Java",
        "city" => "Surabaya",
        "subdistrict" => "Sawahan",
        "address" => "Jl. Diponegoro, Surabaya",
        "signature_name" => "Azura Mishimoto",
        "contact_person" => "Azura Mishimoto",
        "tin" => "01.234.567.8-901.000",
        "website" => "rakhainvoice.semanggilima.my.id",
    ],
];

$comp = $company[0];

// Badge color per entity type. Fallback ke 'secondary' kalau entity baru.
$entityBadgeMap = [
    "E-commerce" => "info",
    "Distributor" => "primary",
    "Retail" => "success",
];
$entityBadgeClass = $entityBadgeMap[$comp['entity']] ?? "secondary";

// Normalize website utk href (biar bisa diklik walau data tanpa protokol)
$websiteHref = preg_match('/^https?:\/\//i', $comp['website'])
    ? $comp['website']
    : 'https://' . $comp['website'];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Company</title>

    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* Ringan, hanya untuk hal yang tidak tersedia di utility Bootstrap */
        .company-logo-frame,
        .signature-frame {
            width: 100%;
            min-height: 130px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .info-icon {
            width: 1.25rem;
            text-align: center;
            display: inline-block;
            margin-right: .25rem;
        }

        .info-label {
            margin-bottom: .15rem;
        }

        .info-value {
            font-weight: 600;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">

    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>

        <?php
        $activePage = 'company';
        include "../component/sidebar.php";
        ?>

        <div class="app-main bg-body-tertiary">

            <div class="app-content p-3">

                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Company Profile Settings</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Company</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <div class="row">

                        <!-- LEFT COLUMN -->
                        <div class="col-lg-8">

                            <!-- Card 1: Company Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">
                                        Company Information
                                    </h3>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row row-gap-3">
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Company Name</div>
                                            <div class="info-value"><?= htmlspecialchars($comp['name']); ?></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label">
                                                Business Entity
                                            </div>
                                            <div>
                                                <span class="badge bg-<?= $entityBadgeClass; ?>">
                                                    <?= htmlspecialchars($comp['entity']); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Company Email</div>
                                            <div class="info-value">
                                                <a href="mailto:<?= htmlspecialchars($comp['email']); ?> "
                                                    class="text-decoration-none">
                                                    <?= htmlspecialchars($comp['email']); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Company Phone</div>
                                            <div class="info-value">
                                                <a href="tel:<?= htmlspecialchars($comp['phone']); ?>"
                                                    class="text-decoration-none">
                                                    <?= htmlspecialchars($comp['phone']); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Country</div>
                                            <div class="info-value"><?= htmlspecialchars($comp['country']); ?></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Province</div>
                                            <div class="info-value"><?= htmlspecialchars($comp['province']); ?></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> City</div>
                                            <div class="info-value"><?= htmlspecialchars($comp['city']); ?></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label"> Subdistrict</div>
                                            <div class="info-value"><?= htmlspecialchars($comp['subdistrict']); ?></div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="text-muted small info-label"> Business Address</div>
                                    <div class="info-value"><?= htmlspecialchars($comp['address']); ?></div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="edit.php?section=company" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Logo & Signature -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">
                                        Logo & Signature
                                    </h3>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row row-gap-3">
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label mb-1">Company Logo</div>
                                            <label for="logoInput"
                                                class="company-logo-frame border rounded p-3 text-muted"
                                                style="cursor:pointer;" id="logoFrame">
                                                <img id="logoPreview" src="" alt="Logo" class="d-none"
                                                    style="max-height:110px;max-width:100%;object-fit:contain;">
                                                <span id="logoPlaceholder">
                                                    <i class="bi bi-image fs-2 mb-1 d-block"></i>
                                                    <span class="small">Click to upload logo</span>
                                                </span>
                                            </label>
                                            <input type="file" id="logoInput" accept="image/*" class="d-none">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-muted small info-label mb-1">Signature</div>
                                            <label for="signatureInput"
                                                class="signature-frame border rounded p-3 text-muted"
                                                style="cursor:pointer;" id="signatureFrame">
                                                <img id="signaturePreview" src="" alt="Signature" class="d-none"
                                                    style="max-height:110px;max-width:100%;object-fit:contain;">
                                                <span id="signaturePlaceholder">
                                                    <i class="bi bi-pencil-square fs-2 mb-1 d-block"></i>
                                                    <span class="small">Click to upload signature</span>
                                                </span>
                                            </label>
                                            <input type="file" id="signatureInput" accept="image/*" class="d-none">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="col-lg-4">

                            <!-- Card 3: Other Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">
                                        Other Information
                                    </h3>
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <div class="text-muted small info-label"> Contact Person</div>
                                        <div class="info-value"><?= htmlspecialchars($comp['contact_person']); ?></div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-muted small info-label"> TIN</div>
                                        <div class="info-value"><?= htmlspecialchars($comp['tin']); ?></div>
                                    </div>
                                    <div>
                                        <div class="text-muted small info-label"> Website</div>
                                        <div class="info-value">
                                            <a href="<?= htmlspecialchars($websiteHref); ?>" target="_blank"
                                                rel="noopener" class="text-decoration-none">
                                                <?= htmlspecialchars($comp['website']); ?> <i
                                                    class="bi bi-box-arrow-up-right small"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="edit.php?section=other" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <?php include "../component/footer.php"; ?>
    </div>
    </div>


    <script src="../dist/js/adminlte.min.js"></script>

    <script>
        function setupImageUpload(inputId, previewId, placeholderId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);

            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                };
                reader.readAsDataURL(file);

                // TODO: kirim file ke server (fetch/AJAX) sesuai backend nanti
            });
        }

        setupImageUpload('logoInput', 'logoPreview', 'logoPlaceholder');
        setupImageUpload('signatureInput', 'signaturePreview', 'signaturePlaceholder');
    </script>

    <?php if (isset($_GET['saved'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast align-items-center text-bg-success border-0" role="alert" id="savedToast">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle"></i> Changes saved successfully.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
        <script>
            new bootstrap.Toast(document.getElementById('savedToast')).show();
        </script>
    <?php endif; ?>

</body>

</html>