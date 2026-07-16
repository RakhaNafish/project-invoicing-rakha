<?php

// Dummy data sama seperti index.php. Tidak ada DB, tidak ada proses simpan real.
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
        "website" => "rakhainvoice.semanggilima.my.id",
    ],
];

$comp = $company[0];

$entityOptions = ["E-commerce", "Distributor", "Retail"];

// Tentukan section mana yang ditampilkan. Default 'all' -> tampil semua (layout lama).
$allowedSections = ['company', 'logo', 'other'];
$section = $_GET['section'] ?? 'all';
if (!in_array($section, $allowedSections, true)) {
    $section = 'all';
}

$showCompany = $section === 'all' || $section === 'company';
$showLogo    = $section === 'all' || $section === 'logo';
$showOther   = $section === 'all' || $section === 'other';

$singleMode = $section !== 'all';
$leftColClass  = $singleMode ? 'col-lg-8 mx-auto' : 'col-lg-8';
$rightColClass = $singleMode ? 'col-lg-8 mx-auto' : 'col-lg-4';

$sectionTitle = [
    'company' => 'Edit Company Information',
    'logo'    => 'Edit Logo & Signature',
    'other'   => 'Edit Other Information',
    'all'     => 'Edit Company',
][$section];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>

    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        .upload-preview-frame {
            width: 100%;
            min-height: 130px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
        }

        .upload-preview-frame img {
            max-height: 110px;
            max-width: 100%;
            object-fit: contain;
        }

        .section-anchor {
            scroll-margin-top: 90px;
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

                <div class="content-header pe-3 pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3><?= htmlspecialchars($sectionTitle); ?></h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end mb-0">
                                    <li class="breadcrumb-item"><a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Company</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <form id="companyEditForm" novalidate>

                        <!-- Action bar -->
                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                        </div>

                        <div class="row">

                            <!-- LEFT COLUMN -->
                            <?php if ($showCompany || $showLogo): ?>
                            <div class="<?= $leftColClass; ?>">

                                <!-- Section: Company Information -->
                                <?php if ($showCompany): ?>
                                <div class="card mb-4 section-anchor" id="companySection">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">
                                            Company Information
                                        </h3>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row row-gap-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="<?= htmlspecialchars($comp['name']); ?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Business Entity</label>
                                                <select name="entity" class="form-select">
                                                    <?php foreach ($entityOptions as $opt): ?>
                                                        <option value="<?= htmlspecialchars($opt); ?>"
                                                            <?= $comp['entity'] === $opt ? 'selected' : ''; ?>>
                                                            <?= htmlspecialchars($opt); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Company Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input type="email" name="email" class="form-control"
                                                        value="<?= htmlspecialchars($comp['email']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Company Phone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-telephone"></i></span>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?= htmlspecialchars($comp['phone']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Country</label>
                                                <input type="text" name="country" class="form-control"
                                                    value="<?= htmlspecialchars($comp['country']); ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Province</label>
                                                <input type="text" name="province" class="form-control"
                                                    value="<?= htmlspecialchars($comp['province']); ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control"
                                                    value="<?= htmlspecialchars($comp['city']); ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Subdistrict</label>
                                                <input type="text" name="subdistrict" class="form-control"
                                                    value="<?= htmlspecialchars($comp['subdistrict']); ?>">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Business Address</label>
                                                <textarea name="address" class="form-control"
                                                    rows="2"><?= htmlspecialchars($comp['address']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Section: Logo & Signature -->
                                <?php if ($showLogo): ?>
                                <div class="card mb-4 section-anchor" id="logoSection">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">
                                            Signature Name
                                        </h3>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row row-gap-3">
                                            <div class="col-12">
                                                <label class="form-label">Signature Name</label>
                                                <input type="text" name="signature_name" class="form-control"
                                                    value="<?= htmlspecialchars($comp['signature_name']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>

                            <!-- RIGHT COLUMN -->
                            <?php if ($showOther): ?>
                            <div class="<?= $rightColClass; ?>">

                                <!-- Section: Other Information -->
                                <div class="card mb-4 section-anchor" id="otherSection">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">
                                            Other Information
                                        </h3>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label">Contact Person</label>
                                            <input type="text" name="contact_person" class="form-control"
                                                value="<?= htmlspecialchars($comp['contact_person']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">TIN</label>
                                            <input type="text" name="tin" class="form-control"
                                                value="<?= htmlspecialchars($comp['tin']); ?>">
                                        </div>
                                        <div>
                                            <label class="form-label">Website</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                                <input type="text" name="website" class="form-control"
                                                    value="<?= htmlspecialchars($comp['website']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php endif; ?>

                        </div>

                        <!-- Bottom action bar, jaga-jaga form panjang -->
                        <!-- <div class="d-flex justify-content-end gap-2 mb-4">
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                        </div> -->

                </div>
                </form>

            </div>
        </div>

    </div>

    </div>
    <?php include "../component/footer.php"; ?>

    <script src="../dist/js/adminlte.min.js"></script>

    <script>
        // Preview upload logo & signature. Ganti icon+text jadi <img> saat file dipilih.
        function bindUploadPreview(inputId, frameId) {
            const input = document.getElementById(inputId);
            const frame = document.getElementById(frameId);
            input.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        frame.innerHTML = `<img src="${e.target.result}" alt="preview">`;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
        bindUploadPreview('logoInput', 'logoPreviewFrame');
        bindUploadPreview('signatureInput', 'signaturePreviewFrame');

        // Simulasi save. Belum ada backend/DB -> cuma validasi + toast + redirect balik ke index.
        document.getElementById('companyEditForm').addEventListener('submit', function (e) {
            e.preventDefault();

            if (!this.checkValidity()) {
                this.classList.add('was-validated');
                const firstInvalid = this.querySelector(':invalid');
                if (firstInvalid) firstInvalid.closest('.section-anchor')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            const submitBtns = this.querySelectorAll('button[type="submit"]');
            submitBtns.forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Saving...';
            });

            setTimeout(() => {
                window.location.href = 'index.php?saved=1';
            }, 700);
        });

        // Auto scroll ke section sesuai hash saat halaman dibuka dari tombol Edit/Change
        if (window.location.hash) {
            const target = document.querySelector(window.location.hash);
            if (target) setTimeout(() => target.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
        }
    </script>

</body>

</html>