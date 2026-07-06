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
        <?php include "../itu diapain/sidebar.php"; ?>

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
                    <div class="card-body">
                        <form method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Keyword</label>
                                <input type="text" name="keyword" class="form-control"
                                    placeholder="No. Invoice / Customer"
                                    value="<?= htmlspecialchars($keyword_filter) ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date From</label>
                                <input type="date" name="tgl_dari" class="form-control"
                                    value="<?= htmlspecialchars($tgl_dari_filter) ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date To</label>
                                <input type="date" name="tgl_ke" class="form-control"
                                    value="<?= htmlspecialchars($tgl_ke_filter) ?>">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                            </div>
                            <div class="col-12">
                                <a href="payment.php" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                                </a>
                            </div>
                        </form>
                    </div>

                    <?php if (count($pembayaran_filtered) > 0): ?>

                        <!-- Tabel List Pembayaran -->

                        <div class="card-header">
                            <h5 class="card-title mb-0 mt-3">Payment List</h5>
                            <div class="row mt-2">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="pembayaran.php" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i> Add Payment
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                        <?php foreach ($pembayaran_filtered as $i => $p): ?>
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
        // Isi modal delete sesuai data row yang diklik
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', e => {
            const btn = e.relatedTarget;
            document.getElementById('deleteInvoiceLabel').textContent = btn.getAttribute('data-invoice');
            document.getElementById('confirmDeleteBtn').dataset.id = btn.getAttribute('data-id');
        });
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            // Sambungkan ke endpoint hapus saat database tersedia
            alert('Pembayaran ID ' + this.dataset.id + ' dihapus (dummy).');
            bootstrap.Modal.getInstance(deleteModal).hide();
        });

        // Pagination & show entries (client-side, search/filter sudah ditangani PHP via GET)
        (function () {
            const table = document.getElementById('tabelPembayaran');
            if (!table) return;
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const showEl = document.getElementById('showEntries');
            const pageCtrl = document.getElementById('paginationControls');
            const pageTxt = document.getElementById('paginationText');
            let currentPage = 1;

            function render() {
                const perPage = parseInt(showEl.value);
                const total = allRows.length;
                const pages = Math.max(1, Math.ceil(total / perPage));
                currentPage = Math.min(currentPage, pages);
                const start = (currentPage - 1) * perPage;

                allRows.forEach(r => r.style.display = 'none');
                allRows.slice(start, start + perPage).forEach(r => r.style.display = '');

                pageTxt.textContent = total === 0
                    ? 'Tidak ada data'
                    : `Menampilkan ${start + 1}–${Math.min(start + perPage, total)} dari ${total} entri`;

                pageCtrl.innerHTML = '';
                for (let p = 1; p <= pages; p++) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (p === currentPage ? ' active' : '');
                    li.innerHTML = `<a class="page-link" href="#">${p}</a>`;
                    li.addEventListener('click', e => { e.preventDefault(); currentPage = p; render(); });
                    pageCtrl.appendChild(li);
                }
            }
            showEl.addEventListener('change', () => { currentPage = 1; render(); });
            render();
        })();
    </script>
</body>

</html>