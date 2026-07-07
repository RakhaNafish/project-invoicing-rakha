<?php

// ============================
// DUMMY DATA - List Pembayaran
// ============================

$keyword_filter = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$tgl_dari_filter = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$tgl_ke_filter = isset($_GET['tgl_ke']) ? $_GET['tgl_ke'] : '';

$pembayaran = [
    ['id' => 1, 'tanggal' => '2026-06-02', 'no_invoice' => 'INV-001', 'customer' => 'Budi Santoso', 'nominal' => 1250000, 'metode' => 'Transfer Bank'],
    ['id' => 2, 'tanggal' => '2026-06-05', 'no_invoice' => 'INV-002', 'customer' => 'Siti Rahayu', 'nominal' => 450000, 'metode' => 'Tunai'],
    ['id' => 3, 'tanggal' => '2026-06-07', 'no_invoice' => 'INV-003', 'customer' => 'Ahmad Fauzi', 'nominal' => 1600000, 'metode' => 'Transfer Bank'],
    ['id' => 4, 'tanggal' => '2026-06-08', 'no_invoice' => 'INV-003', 'customer' => 'Ahmad Fauzi', 'nominal' => 1600000, 'metode' => 'Transfer Bank'],
    ['id' => 5, 'tanggal' => '2026-06-10', 'no_invoice' => 'INV-005', 'customer' => 'Rizky Pratama', 'nominal' => 2100000, 'metode' => 'QRIS'],
    ['id' => 6, 'tanggal' => '2026-06-12', 'no_invoice' => 'INV-006', 'customer' => 'Nurul Hidayah', 'nominal' => 750000, 'metode' => 'Tunai'],
    ['id' => 7, 'tanggal' => '2026-06-14', 'no_invoice' => 'INV-007', 'customer' => 'Hendra Wijaya', 'nominal' => 3000000, 'metode' => 'Transfer Bank'],
    ['id' => 8, 'tanggal' => '2026-06-15', 'no_invoice' => 'INV-007', 'customer' => 'Hendra Wijaya', 'nominal' => 1800000, 'metode' => 'Transfer Bank'],
    ['id' => 9, 'tanggal' => '2026-06-17', 'no_invoice' => 'INV-009', 'customer' => 'Doni Setiawan', 'nominal' => 1500000, 'metode' => 'QRIS'],
    ['id' => 10, 'tanggal' => '2026-06-19', 'no_invoice' => 'INV-010', 'customer' => 'Maya Anggraini', 'nominal' => 2250000, 'metode' => 'Transfer Bank'],
    ['id' => 11, 'tanggal' => '2026-06-21', 'no_invoice' => 'INV-011', 'customer' => 'Fajar Nugroho', 'nominal' => 5600000, 'metode' => 'Transfer Bank'],
    ['id' => 12, 'tanggal' => '2026-06-23', 'no_invoice' => 'INV-012', 'customer' => 'Laila Sari', 'nominal' => 450000, 'metode' => 'Tunai'],
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php
        $activePage = 'payment';
        include "../itu diapain/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Payment</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Payment</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Pencarian -->
                <div class="card">
                    <div class="card-header">

                        <!-- Baris Atas -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="input-group input-group-sm" style="width:280px;">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input id="searchInput" type="text" class="form-control" placeholder="Search">
                            </div>

                            <a href="pembayaran.php" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i>
                                Add Payment
                            </a>

                        </div>

                        <!-- Baris Filter -->
                        <form method="GET" class="row g-2 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label">Keyword</label>
                                <input type="text" id="keywordFilter" class="form-control form-control-sm"
                                    placeholder="Invoice / Customer">
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
                                            <th style="width:50px">No</th>
                                            <th>Date</th>
                                            <th>No. Inv</th>
                                            <th>Customer</th>
                                            <th class="text-end">Amount</th>
                                            <th class="text-center" style="width:130px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pembayaran as $i => $p): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= ($p['tanggal']) ?></td>
                                                <td><?= htmlspecialchars($p['no_invoice']) ?></td>
                                                <td><?= htmlspecialchars($p['customer']) ?></td>
                                                <td class="text-end fw-semibold"><?= rupiah($p['nominal']) ?></td>
                                                <td class="text-center">
                                                    <a href="pembayaran.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning"
                                                        title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" data-id="<?= $p['id'] ?>"
                                                        data-invoice="<?= htmlspecialchars($p['no_invoice']) ?>" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
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
                        </>
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

        <?php include "../itu diapain/footer.php"; ?>
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
                    <p class="mt-3 mb-0">Hapus pembayaran untuk invoice <strong id="deleteInvoiceLabel"></strong>?</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">Hapus</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        (() => {

            const table = document.getElementById("tabelPembayaran");
            if (!table) return;

            const rows = Array.from(table.querySelectorAll("tbody tr"));

            const globalSearch = document.getElementById("searchInput");
            const keywordFilter = document.getElementById("keywordFilter");
            const dateFrom = document.getElementById("dateFrom");
            const dateTo = document.getElementById("dateTo");
            const resetBtn = document.getElementById("resetFilterBtn");

            const pageCtrl = document.getElementById("paginationControls");
            const pageTxt = document.getElementById("paginationText");

            const perPage = 10;
            let currentPage = 1;

            function getFilteredRows() {

                const global = globalSearch.value.toLowerCase().trim();
                const keyword = keywordFilter.value.toLowerCase().trim();
                const from = dateFrom.value;
                const to = dateTo.value;

                return rows.filter(row => {

                    const date = row.cells[1].textContent.trim();
                    const invoice = row.cells[2].textContent.toLowerCase();
                    const customer = row.cells[3].textContent.toLowerCase();

                    const allText = row.textContent.toLowerCase();

                    const matchGlobal =
                        global === "" ||
                        allText.includes(global);

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

                    return matchGlobal && matchKeyword && matchFrom && matchTo;

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
                    pageTxt.textContent = "Tidak ada data";
                } else {
                    pageTxt.textContent =
                        `Menampilkan ${start + 1} - ${Math.min(end, total)} dari ${total} data`;
                }

                pageCtrl.innerHTML = "";

                for (let i = 1; i <= totalPages; i++) {

                    const li = document.createElement("li");
                    li.className = "page-item" + (i === currentPage ? " active" : "");

                    li.innerHTML =
                        `<a href="#" class="page-link">${i}</a>`;

                    li.onclick = function (e) {

                        e.preventDefault();

                        currentPage = i;

                        renderTable();

                    };

                    pageCtrl.appendChild(li);

                }

            }

            globalSearch.addEventListener("input", () => {
                currentPage = 1;
                renderTable();
            });

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

                globalSearch.value = "";
                keywordFilter.value = "";
                dateFrom.value = "";
                dateTo.value = "";

                currentPage = 1;

                renderTable();

            });

            renderTable();

        })();
    </script>
</body>

</html>