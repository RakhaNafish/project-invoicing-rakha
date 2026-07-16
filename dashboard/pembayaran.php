<?php

// ============================
// DUMMY DATA - Form Pembayaran
// ============================

$edit_id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Asal halaman: 'invoice' = dari tombol Pay Now di invoice, default = dari payment.php
$from = isset($_GET['from']) ? $_GET['from'] : '';
$backUrl = ($from === 'invoice') ? '../invoice/invoice.php' : 'payment.php';

// Daftar invoice yang masih punya tagihan (dummy, untuk dropdown pilih invoice)
$daftar_invoice = [
    ['no_invoice' => 'INV-004', 'customer' => 'Dewi Lestari', 'total_invoice' => 900000, 'sudah_dibayar' => 0, 'sisa' => 900000],
    ['no_invoice' => 'INV-008', 'customer' => 'Rina Kusuma', 'total_invoice' => 300000, 'sudah_dibayar' => 0, 'sisa' => 300000],
    ['no_invoice' => 'INV-013', 'customer' => 'Teguh Wibowo', 'total_invoice' => 1900000, 'sudah_dibayar' => 500000, 'sisa' => 1400000],
    ['no_invoice' => 'INV-007', 'customer' => 'Hendra Wijaya', 'total_invoice' => 4800000, 'sudah_dibayar' => 4800000, 'sisa' => 0],
];

// Jika mode edit, ambil data pembayaran existing (dummy)
$data_edit = null;
if ($edit_id !== null) {
    $data_edit = [
        'id' => $edit_id,
        'tanggal' => '2026-06-21',
        'no_invoice' => 'INV-011',
        'customer' => 'Fajar Nugroho',
        'total_invoice' => 5600000,
        'sisa_sebelum' => 5600000,
        'nominal' => 5600000,
        'metode' => 'Transfer Bank',
        'keterangan' => 'Pelunasan via BCA',
    ];
}

// Jika datang dari tombol Pay Now di invoice, prefill invoice terkait
$prefill_invoice = null;
if (!$data_edit && $from === 'invoice' && isset($_GET['no_invoice'])) {
    $prefill_invoice = [
        'no_invoice' => $_GET['no_invoice'],
        'customer' => $_GET['customer'] ?? '',
        'total_invoice' => (int) ($_GET['total'] ?? 0),
        'sudah_dibayar' => 0,
        'sisa' => (int) ($_GET['total'] ?? 0),
    ];
    array_unshift($daftar_invoice, $prefill_invoice);
}

// Data invoice terpilih untuk render awal (edit ATAU prefill dari Pay Now)
$initial = null;
if ($data_edit) {
    $initial = [
        'no_invoice' => $data_edit['no_invoice'],
        'customer' => $data_edit['customer'],
        'total_invoice' => $data_edit['total_invoice'],
        'dibayar' => 0,
        'sisa' => $data_edit['sisa_sebelum'],
    ];
} elseif ($prefill_invoice) {
    $initial = [
        'no_invoice' => $prefill_invoice['no_invoice'],
        'customer' => $prefill_invoice['customer'],
        'total_invoice' => $prefill_invoice['total_invoice'],
        'dibayar' => 0,
        'sisa' => $prefill_invoice['sisa'],
    ];
}

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
    <title><?= $data_edit ? 'Edit Pembayaran' : 'Tambah Pembayaran' ?></title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .invoice-info-box {
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 8px;
            padding: 16px;
            background: rgba(255, 255, 255, .03);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: .9rem;
        }

        .info-row .label {
            color: #8a94a6;
        }

        .sisa-highlight {
            font-size: 1.4rem;
            font-weight: 700;
            color: #e35d6a;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php include "../component/sidebar.php"; ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3><?= $data_edit ? 'Edit Payment' : 'Add Payment' ?></h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end mb-0">
                                    <li class="breadcrumb-item"><a href="dashboard.php"
                                            class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="payment.php"
                                            class="text-decoration-none">Payment</a></li>
                                    <li class="breadcrumb-item active"><?= $data_edit ? 'Edit' : 'Add' ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?= $data_edit ? 'Form Edit Payment' : 'Form Payment Invoice' ?>
                            </h3>
                        </div>
                        <div class="card-body">

                            <form id="formPembayaran" method="POST" action="#">

                                <?php if ($data_edit): ?>
                                    <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
                                <?php endif; ?>
                                <input type="hidden" name="from" value="<?= htmlspecialchars($from) ?>">

                                <!-- Pilih Invoice -->
                                <div class="mb-3">
                                    <label class="form-label">Choose Invoice <span class="text-danger">*</span></label>
                                    <select name="no_invoice" id="selectInvoice" class="form-select" required <?= $data_edit ? 'disabled' : '' ?>>
                                        <option value="">-- Invoice --</option>
                                        <?php foreach ($daftar_invoice as $inv): ?>
                                            <option value="<?= $inv['no_invoice'] ?>"
                                                data-customer="<?= htmlspecialchars($inv['customer']) ?>"
                                                data-total="<?= $inv['total_invoice'] ?>"
                                                data-dibayar="<?= $inv['sudah_dibayar'] ?>" data-sisa="<?= $inv['sisa'] ?>"
                                                <?= $initial && $initial['no_invoice'] === $inv['no_invoice'] ? 'selected' : '' ?>
                                                <?= $inv['sisa'] <= 0 ? 'disabled' : '' ?>>
                                                <?= $inv['no_invoice'] ?> — <?= $inv['customer'] ?>
                                                <?= $inv['sisa'] <= 0 ? '(Lunas)' : '' ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <?php if ($data_edit): ?>
                                            <option value="<?= $data_edit['no_invoice'] ?>" selected
                                                data-customer="<?= htmlspecialchars($data_edit['customer']) ?>"
                                                data-total="<?= $data_edit['total_invoice'] ?>" data-dibayar="0"
                                                data-sisa="<?= $data_edit['sisa_sebelum'] ?>">
                                                <?= $data_edit['no_invoice'] ?> — <?= $data_edit['customer'] ?>
                                            </option>
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($data_edit): ?>
                                        <small class="text-muted">The invoice cannot be modified in edit mode.</small>
                                    <?php endif; ?>
                                </div>

                                <!-- Info Invoice -->
                                <div class="invoice-info-box mb-4" id="invoiceInfoBox"
                                    style="<?= $initial ? '' : 'display:none' ?>">
                                    <div class="info-row">
                                        <span class="label">Customer</span>
                                        <span class="fw-semibold"
                                            id="infoCustomer"><?= $initial ? htmlspecialchars($initial['customer']) : '-' ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="label">Total Invoice</span>
                                        <span
                                            id="infoTotal"><?= $initial ? rupiah($initial['total_invoice']) : '-' ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="label">Already paid</span>
                                        <span id="infoDibayar"><?= $initial ? rupiah($initial['dibayar']) : '-' ?></span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="info-row">
                                        <span class="label">Rest of the bill</span>
                                        <span class="sisa-highlight"
                                            id="infoSisa"><?= $initial ? rupiah($initial['sisa']) : '-' ?></span>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <!-- Tanggal -->
                                    <div class="col-md-6">
                                        <label class="form-label">Date Payment <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal" class="form-control" required
                                            value="<?= $data_edit ? $data_edit['tanggal'] : date('Y-m-d') ?>">
                                    </div>

                                    <!-- Metode -->
                                    <div class="col-md-6">
                                        <label class="form-label">Payment Methods <span class="text-danger">*</span></label>
                                        <select name="metode" class="form-select" required>
                                            <?php
                                            $metode_list = ['Cash', 'Bank Transfer', 'QRIS', 'Debit Card', 'Credit Card'];
                                            foreach ($metode_list as $m):
                                                ?>
                                                <option value="<?= $m ?>" <?= ($data_edit && $data_edit['metode'] === $m) ? 'selected' : '' ?>><?= $m ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Nominal -->
                                    <div class="col">
                                        <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="nominal" id="inputNominal" class="form-control"
                                                min="1" required placeholder="0"
                                                value="<?= $data_edit ? $data_edit['nominal'] : '' ?>">
                                        </div>
                                        <small class="text-muted">Up to a maximum of the outstanding balance</small>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="col-12">
                                        <label class="form-label">Information</label>
                                        <textarea name="keterangan" class="form-control" rows="3"
                                            placeholder="Additional notes (opsional)"><?= $data_edit ? htmlspecialchars($data_edit['keterangan']) : '' ?></textarea>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-start gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <?= $data_edit ? 'Save' : 'Save' ?>
                                    </button>
                                    <a href="<?= htmlspecialchars($backUrl) ?>" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                </div>

                            </form>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const selectInvoice = document.getElementById('selectInvoice');
        const infoBox = document.getElementById('invoiceInfoBox');
        const infoCustomer = document.getElementById('infoCustomer');
        const infoTotal = document.getElementById('infoTotal');
        const infoDibayar = document.getElementById('infoDibayar');
        const infoSisa = document.getElementById('infoSisa');
        const inputNominal = document.getElementById('inputNominal');

        function rupiahJS(n) {
            return 'Rp ' + Number(n).toLocaleString('id-ID');
        }

        let baseTotal = 0;
        let baseDibayar = 0;
        let baseSisa = 0;

        function updateInfo() {
            const opt = selectInvoice.options[selectInvoice.selectedIndex];
            if (!opt || !opt.value) {
                infoBox.style.display = 'none';
                return;
            }
            baseTotal = parseInt(opt.dataset.total || 0);
            baseDibayar = parseInt(opt.dataset.dibayar || 0);
            baseSisa = parseInt(opt.dataset.sisa || 0);

            infoCustomer.textContent = opt.dataset.customer || '-';
            infoTotal.textContent = rupiahJS(baseTotal);
            infoBox.style.display = '';

            inputNominal.max = baseSisa;
            if (!inputNominal.value) inputNominal.value = baseSisa;

            updateNominalPreview();
        }

        function updateNominalPreview() {
            const nominal = parseInt(inputNominal.value || 0);
            const dibayarNow = baseDibayar + nominal;
            const sisaNow = baseTotal - dibayarNow;

            infoDibayar.textContent = rupiahJS(dibayarNow);
            infoSisa.textContent = rupiahJS(sisaNow < 0 ? 0 : sisaNow);
        }

        selectInvoice.addEventListener('change', updateInfo);
        inputNominal.addEventListener('input', updateNominalPreview);
        if (selectInvoice.value) updateInfo();

        // Validasi sederhana: nominal tidak boleh melebihi sisa tagihan
        document.getElementById('formPembayaran').addEventListener('submit', function (e) {
            const max = parseInt(inputNominal.max || 0);
            const val = parseInt(inputNominal.value || 0);
            if (max > 0 && val > max) {
                e.preventDefault();
                alert('The nominal payment cannot exceed the remaining balance (' + rupiahJS(max) + ').');
            }
        });
    </script>
</body>

</html>