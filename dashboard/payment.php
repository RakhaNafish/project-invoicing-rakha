<?php

// DUMMY DATA - List Pembayaran

$keyword_filter = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$tgl_dari_filter = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$tgl_ke_filter = isset($_GET['tgl_ke']) ? $_GET['tgl_ke'] : '';

$pembayaran = [
    ['id' => 1, 'tanggal' => '02-06-2026', 'no_invoice' => 'INV-001', 'customer' => 'Budi Santoso', 'nominal' => 1250000, 'metode' => 'Transfer Bank'],
    ['id' => 2, 'tanggal' => '05-06-2026', 'no_invoice' => 'INV-002', 'customer' => 'Siti Rahayu', 'nominal' => 450000, 'metode' => 'Tunai'],
    ['id' => 3, 'tanggal' => '07-06-2026', 'no_invoice' => 'INV-003', 'customer' => 'Ahmad Fauzi', 'nominal' => 1600000, 'metode' => 'Transfer Bank'],
    ['id' => 4, 'tanggal' => '08-06-2026', 'no_invoice' => 'INV-003', 'customer' => 'Ahmad Fauzi', 'nominal' => 1600000, 'metode' => 'Transfer Bank'],
    ['id' => 5, 'tanggal' => '10-06-2026', 'no_invoice' => 'INV-005', 'customer' => 'Rizky Pratama', 'nominal' => 2100000, 'metode' => 'QRIS'],
    ['id' => 6, 'tanggal' => '12-06-2026', 'no_invoice' => 'INV-006', 'customer' => 'Nurul Hidayah', 'nominal' => 750000, 'metode' => 'Tunai'],
    ['id' => 7, 'tanggal' => '14-06-2026', 'no_invoice' => 'INV-007', 'customer' => 'Hendra Wijaya', 'nominal' => 3000000, 'metode' => 'Transfer Bank'],
    ['id' => 8, 'tanggal' => '15-06-2026', 'no_invoice' => 'INV-007', 'customer' => 'Hendra Wijaya', 'nominal' => 1800000, 'metode' => 'Transfer Bank'],
    ['id' => 9, 'tanggal' => '17-06-2026', 'no_invoice' => 'INV-009', 'customer' => 'Doni Setiawan', 'nominal' => 1500000, 'metode' => 'QRIS'],
    ['id' => 10, 'tanggal' => '19-06-2026', 'no_invoice' => 'INV-010', 'customer' => 'Maya Anggraini', 'nominal' => 2250000, 'metode' => 'Transfer Bank'],
    ['id' => 11, 'tanggal' => '21-06-2026', 'no_invoice' => 'INV-011', 'customer' => 'Fajar Nugroho', 'nominal' => 5600000, 'metode' => 'Transfer Bank'],
    ['id' => 12, 'tanggal' => '23-06-2026', 'no_invoice' => 'INV-012', 'customer' => 'Laila Sari', 'nominal' => 450000, 'metode' => 'Tunai'],
];

// ── Filter sederhana (di sisi PHP, dummy) ─────────────────
$pembayaran_filtered = array_filter($pembayaran, function ($p) use ($keyword_filter, $tgl_dari_filter, $tgl_ke_filter) {
    $match = true;

    if ($keyword_filter !== '') {
        $haystack = strtolower($p['no_invoice'] . ' ' . $p['customer']);
        $match = $match && str_contains($haystack, strtolower($keyword_filter));
    }
    if ($tgl_dari_filter !== '') {
        $match = $match && ($p['tanggal'] >= $tgl_dari_filter);
    }
    if ($tgl_ke_filter !== '') {
        $match = $match && ($p['tanggal'] <= $tgl_ke_filter);
    }
    return $match;
});
$pembayaran_filtered = array_values($pembayaran_filtered);

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
    <title>Payment</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .summary-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .table-card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 16px;
        }

        .table-responsive {
            overflow: visible;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php
        $activePage = 'payment';
        include "../component/sidebar.php"; ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">
                <!-- Page Header -->
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Payment</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="dashboard.php"
                                            class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Payment</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <!-- Filter Pencarian -->
                    <div class="card">
                        <div class="card-header">

                            <!-- Baris Atas -->
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <!-- <div class="input-group input-group-sm" style="width:280px;">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input id="searchInput" type="text" class="form-control" placeholder="Search">
                                </div> -->

                                <a href="pembayaran.php" class="btn btn-primary ms-auto">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add Payment
                                </a>

                            </div>

                            <!-- Baris Filter -->
                            <form method="GET" class="row g-2 align-items-end">

                                <div class="col-md-4">
                                    <label class="form-label">Keyword</label>
                                    <input type="text" id="keywordFilter" class="form-control form-control-sm"
                                        placeholder="Customer...">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Date From</label>
                                    <input type="date" id="dateFrom" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Date To</label>
                                    <input type="date" id="dateTo" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" id="resetFilterBtn" class="btn btn-secondary btn-sm w-100">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Reset
                                    </button>
                                </div>

                            </form>

                        </div>

                        <?php if (count($pembayaran_filtered) > 0): ?>

                            <!-- Tabel List Pembayaran -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelPembayaran">
                                        <thead>
                                            <tr>
                                                <th style="width:50px" class="text-center">No</th>
                                                <th class="text-center">No. Inv</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th class="text-end">Amount</th>
                                                <th class="text-center" style="width:130px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pembayaran as $i => $p): ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($p['no_invoice']) ?></td>
                                                    <td><?= ($p['tanggal']) ?></td>
                                                    <td><?= htmlspecialchars($p['customer']) ?></td>
                                                    <td class="text-end fw-semibold"><?= rupiah($p['nominal']) ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <!-- <li>
                                                                    <a class="dropdown-item text-warning"
                                                                        href="pembayaran.php?id=<?= $p['id'] ?>">
                                                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                                                    </a>
                                                                </li> -->
                                                                <li>
                                                                    <button type="button" class="dropdown-item text-danger"
                                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-invoice="<?= htmlspecialchars($p['no_invoice']) ?>">
                                                                        <i class="bi bi-trash me-1"></i> Delete
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span id="paginationText" class="small text-muted"></span>
                                    <ul class="pagination pagination-sm mb-0" id="paginationControls"></ul>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="card">
                            <div class="card-body empty-state">
                                <i class="bi bi-inbox d-block"></i>
                                <p class="mb-0">Tidak ada data pembayaran yang cocok dengan pencarian.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php include "../component/footer.php"; ?>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center pt-0">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size:2.5rem"></i>
                        <p class="mt-3 mb-0">Hapus pembayaran untuk invoice <strong id="deleteInvoiceLabel"></strong>?
                        </p>
                    </div>
                    <div class="modal-footer justify-content-center border-0 pt-0">
                        <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">Hapus</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../dist/js/adminlte.min.js"></script>
        <script>
            (() => {

                const table = document.getElementById("tabelPembayaran");
                if (!table) return;

                const rows = Array.from(table.querySelectorAll("tbody tr"));

                // const globalSearch = document.getElementById("searchInput");
                const keywordFilter = document.getElementById("keywordFilter");
                const dateFrom = document.getElementById("dateFrom");
                const dateTo = document.getElementById("dateTo");
                const resetBtn = document.getElementById("resetFilterBtn");

                const pageCtrl = document.getElementById("paginationControls");
                const pageTxt = document.getElementById("paginationText");

                const perPage = 10;
                let currentPage = 1;

                function getFilteredRows() {

                    const keyword = keywordFilter.value.toLowerCase().trim();
                    const from = dateFrom.value;
                    const to = dateTo.value;

                    return rows.filter(row => {

                        const date = row.cells[1].textContent.trim();
                        const invoice = row.cells[2].textContent.toLowerCase();
                        const customer = row.cells[3].textContent.toLowerCase();

                        const matchKeyword =
                            keyword === "" ||
                            invoice.includes(keyword) ||
                            customer.includes(keyword);

                        const matchFrom =
                            from === "" ||
                            date >= from;

                        const matchTo =
                            to === "" ||
                            date <= to;

                        return matchKeyword && matchFrom && matchTo;

                    });

                }

                function renderTable() {

                    const filtered = getFilteredRows();

                    const total = filtered.length;

                    const totalPages = Math.max(1, Math.ceil(total / perPage));

                    if (currentPage > totalPages)
                        currentPage = totalPages;

                    const start = (currentPage - 1) * perPage;
                    const end = start + perPage;

                    rows.forEach(row => row.style.display = "none");

                    filtered.slice(start, end).forEach(row => {
                        row.style.display = "";
                    });

                    if (total === 0) {
                        pageTxt.textContent = "No data avaiable";
                    } else {
                        pageTxt.textContent =
                            `Show ${start + 1} - ${Math.min(end, total)} from ${total} data`;
                    }

                    pageCtrl.innerHTML = "";

                    function addPage(label, targetPage, opts = {}) {

                        const li = document.createElement("li");

                        li.className =
                            "page-item" +
                            (opts.active ? " active" : "") +
                            (opts.disabled ? " disabled" : "");

                        if (opts.disabled) {
                            li.innerHTML = `<span class="page-link">${label}</span>`;
                        } else {
                            li.innerHTML = `<a href="#" class="page-link">${label}</a>`;
                            li.onclick = function (e) {
                                e.preventDefault();
                                currentPage = targetPage;
                                renderTable();
                            };
                        }

                        pageCtrl.appendChild(li);

                    }

                    // Previous
                    addPage("Previous", currentPage - 1, { disabled: currentPage <= 1 });

                    // Page 1
                    addPage("1", 1, { active: currentPage === 1 });

                    // Titik awal
                    if (currentPage > 3) {
                        addPage("...", null, { disabled: true });
                    }

                    // Page sekitar current
                    for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
                        addPage(String(i), i, { active: currentPage === i });
                    }

                    // Titik akhir
                    if (currentPage < totalPages - 2) {
                        addPage("...", null, { disabled: true });
                    }

                    // Last page
                    if (totalPages > 1) {
                        addPage(String(totalPages), totalPages, { active: currentPage === totalPages });
                    }

                    // Next
                    addPage("Next", currentPage + 1, { disabled: currentPage >= totalPages });

                }

                keywordFilter.addEventListener("input", () => {
                    currentPage = 1;
                    renderTable();
                });

                dateFrom.addEventListener("change", () => {
                    currentPage = 1;
                    renderTable();
                });

                dateTo.addEventListener("change", () => {
                    currentPage = 1;
                    renderTable();
                });

                resetBtn.addEventListener("click", () => {

                    keywordFilter.value = "";
                    dateFrom.value = "";
                    dateTo.value = "";

                    currentPage = 1;

                    renderTable();

                });

                renderTable();

                const deleteModalEl = document.getElementById("deleteModal");
                const deleteInvoiceLabel = document.getElementById("deleteInvoiceLabel");
                const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
                let deleteTargetId = null;

                deleteModalEl.addEventListener("show.bs.modal", (event) => {
                    const trigger = event.relatedTarget;
                    if (!trigger) return;

                    deleteTargetId = trigger.getAttribute("data-id");
                    deleteInvoiceLabel.textContent = trigger.getAttribute("data-invoice");
                });

                confirmDeleteBtn.addEventListener("click", () => {
                    if (!deleteTargetId) return;

                    // TODO: ganti dengan request hapus data asli (fetch/AJAX ke backend)
                    console.log("Hapus payment id:", deleteTargetId);

                    const modal = bootstrap.Modal.getInstance(deleteModalEl);
                    modal.hide();
                });

            })();
        </script>
</body>

</html>