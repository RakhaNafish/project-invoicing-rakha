<?php

// ============================
// DUMMY DATA - Outstanding Balance Customer
// ============================

$keyword_filter = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$outstanding = [
    ['invoice_no' => 'INV-001', 'customer' => 'Dewi Lestari', 'tanggal_invoice' => '2026-05-02', 'jatuh_tempo' => '2026-06-01', 'total_invoice' => 2100000, 'total_terbayar' => 1200000,],
    ['invoice_no' => 'INV-002', 'customer' => 'Rina Kusuma', 'tanggal_invoice' => '2026-05-10', 'jatuh_tempo' => '2026-06-09', 'total_invoice' => 950000, 'total_terbayar' => 650000,],
    ['invoice_no' => 'INV-003', 'customer' => 'Teguh Wibowo', 'tanggal_invoice' => '2026-04-18', 'jatuh_tempo' => '2026-05-18', 'total_invoice' => 4300000, 'total_terbayar' => 2900000,],
    ['invoice_no' => 'INV-004', 'customer' => 'Siti Rahayu', 'tanggal_invoice' => '2026-06-01', 'jatuh_tempo' => '2026-07-01', 'total_invoice' => 1450000, 'total_terbayar' => 450000,],
    ['invoice_no' => 'INV-005', 'customer' => 'Ahmad Fauzi', 'tanggal_invoice' => '2026-03-22', 'jatuh_tempo' => '2026-04-21', 'total_invoice' => 6200000, 'total_terbayar' => 3200000,],
    ['invoice_no' => 'INV-006', 'customer' => 'Nurul Hidayah', 'tanggal_invoice' => '2026-05-25', 'jatuh_tempo' => '2026-06-24', 'total_invoice' => 1500000, 'total_terbayar' => 750000,],
    ['invoice_no' => 'INV-007', 'customer' => 'Doni Setiawan', 'tanggal_invoice' => '2026-04-30', 'jatuh_tempo' => '2026-05-30', 'total_invoice' => 3000000, 'total_terbayar' => 1500000,],
    ['invoice_no' => 'INV-008', 'customer' => 'Laila Sari', 'tanggal_invoice' => '2026-06-10', 'jatuh_tempo' => '2026-07-10', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['invoice_no' => 'INV-020', 'customer' => 'Budi Santoso', 'tanggal_invoice' => '2026-05-01', 'jatuh_tempo' => '2026-05-31', 'total_invoice' => 3850000, 'total_terbayar' => 3850000,],
    ['invoice_no' => 'INV-021', 'customer' => 'Rizky Pratama', 'tanggal_invoice' => '2026-05-03', 'jatuh_tempo' => '2026-06-02', 'total_invoice' => 2100000, 'total_terbayar' => 2100000,],
];

// Hitung sisa tagihan + status (Overdue jika lewat jatuh tempo, selain itu Pending)
foreach ($outstanding as &$o) {
    $o['sisa_tagihan'] = $o['total_invoice'] - $o['total_terbayar'];
    $o['status'] = strtotime($o['jatuh_tempo']) < strtotime('today') ? 'Overdue' : 'Pending';
}
unset($o);

// Filter → hanya yang belum lunas
$outstanding = array_values(array_filter($outstanding, fn($o) => $o['sisa_tagihan'] > 0));

// Urutkan dari sisa tagihan terbesar
usort($outstanding, fn($a, $b) => $b['sisa_tagihan'] <=> $a['sisa_tagihan']);

$jumlah_customer_outstanding = count($outstanding);
$total_outstanding = array_sum(array_column($outstanding, 'sisa_tagihan'));

function rupiah(int $n): string
{
    return 'Rp ' . number_format($n, 0, ',', '.');
}

function formatTanggal(string $tgl): string
{
    return date('d/m/Y', strtotime($tgl));
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outstanding Balance</title>
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

        .sort-icon {
            font-size: .75rem;
            margin-left: 4px;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php
        $activePage = 'outstanding';
        include "../component/sidebar.php";
        ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3>Customer Outstanding Balance</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="dashboard.php"
                                            class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Outstanding</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <!-- Filter -->
                    <div class="card table-card">
                        <div class="card-header">

                            <!-- Baris Filter -->
                            <div class="row g-2 align-items-end">

                                <div class="col-md-4">
                                    <label class="form-label">Keyword</label>
                                    <input type="text" id="customerSearch" class="form-control form-control-sm"
                                        placeholder="Customer...">
                                </div>

                                <div class="col-md-3 ms-auto">
                                    <button type="button" id="resetFilterBtn" class="btn btn-secondary btn-sm w-100">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                                        Reset Filter
                                    </button>
                                </div>

                            </div>

                        </div>

                        <?php if (count($outstanding) > 0): ?>

                            <!-- Tabel Outstanding -->
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Outstanding Details by Customer</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle" id="tabelOutstanding">
                                        <thead>
                                            <tr>
                                                <th data-col="0">Inv No.</th>
                                                <th data-col="1">Customer</th>
                                                <th class="sortable" data-col="2">Invoice Date <i class="bi sort-icon"></i></th>
                                                <th class="sortable" data-col="3">Due Date <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="4">Total Invoice <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="5">Total Paid Off <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="6">Outstanding <i class="bi sort-icon"></i></th>
                                                <th class="text-center" data-col="7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($outstanding as $o): ?>
                                                <tr>
                                                    <td class="fw-semibold"><?= htmlspecialchars($o['invoice_no']) ?></td>
                                                    <td class="fw-semibold"><?= htmlspecialchars($o['customer']) ?></td>
                                                    <td data-sort="<?= strtotime($o['tanggal_invoice']) ?>">
                                                        <?= formatTanggal($o['tanggal_invoice']) ?>
                                                    </td>
                                                    <td data-sort="<?= strtotime($o['jatuh_tempo']) ?>">
                                                        <?= formatTanggal($o['jatuh_tempo']) ?>
                                                    </td>
                                                    <td class="text-end" data-sort="<?= $o['total_invoice'] ?>">
                                                        <?= rupiah($o['total_invoice']) ?>
                                                    </td>
                                                    <td class="text-end text-success" data-sort="<?= $o['total_terbayar'] ?>">
                                                        <?= rupiah($o['total_terbayar']) ?>
                                                    </td>
                                                    <td class="text-end fw-semibold text-danger"
                                                        data-sort="<?= $o['sisa_tagihan'] ?>">
                                                        <?= rupiah($o['sisa_tagihan']) ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="pembayaran.php?<?= http_build_query([
                                                            'from' => 'outstanding',
                                                            'no_invoice' => $o['invoice_no'],
                                                            'customer' => $o['customer'],
                                                            'total' => $o['total_invoice'],
                                                            'dibayar' => $o['total_terbayar'],
                                                            'status' => $o['status'],
                                                        ]) ?>" class="btn btn-primary btn-sm">
                                                            Pay
                                                        </a>
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

                        <?php else: ?>
                            <div class="card-body empty-state">
                                <i class="bi bi-inbox d-block"></i>
                                <p class="mb-0">No customer with outstanding balance.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
        <?php include "../component/footer.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        (function () {
            const table = document.getElementById('tabelOutstanding');
            if (!table) return;
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const customerSearch = document.getElementById('customerSearch');
            const perPage = 10;
            const resetBtn = document.getElementById('resetFilterBtn');
            const pageCtrl = document.getElementById('paginationControls');
            const pageTxt = document.getElementById('paginationText');
            let sortCol = -1, sortAsc = true, currentPage = 1;

            function filterRows() {
                
                const customerKeyword = customerSearch.value.toLowerCase();

                return allRows.filter(row => {

                    const customer = row.cells[1].textContent.toLowerCase();

                    const matchCustomer =
                        !customerKeyword ||
                        customer.includes(customerKeyword);

                    return matchCustomer;

                });

            }
            function sortRows(rows) {
                if (sortCol < 0) return rows;
                return [...rows].sort((a, b) => {
                    const aCell = a.cells[sortCol];
                    const bCell = b.cells[sortCol];
                    const aSort = aCell?.dataset.sort;
                    const bSort = bCell?.dataset.sort;
                    let cmp;
                    if (aSort !== undefined && bSort !== undefined) {
                        cmp = parseFloat(aSort) - parseFloat(bSort);
                    } else {
                        const av = aCell?.textContent.trim() || '';
                        const bv = bCell?.textContent.trim() || '';
                        cmp = av.localeCompare(bv, 'id');
                    }
                    return sortAsc ? cmp : -cmp;
                });
            }
            function updateSortIcons() {
                table.querySelectorAll('th.sortable').forEach(th => {
                    const icon = th.querySelector('.sort-icon');
                    const col = parseInt(th.dataset.col);
                    icon.className = 'bi sort-icon' +
                        (col !== sortCol ? ' bi-arrow-down-up text-muted' :
                            sortAsc ? ' bi-sort-up' : ' bi-sort-down');
                });
            }
            function render() {
                updateSortIcons();
                const filtered = sortRows(filterRows());
                const total = filtered.length;
                const pages = Math.max(1, Math.ceil(total / perPage));
                currentPage = Math.min(currentPage, pages);
                const start = (currentPage - 1) * perPage;
                allRows.forEach(r => r.style.display = 'none');
                filtered.slice(start, start + perPage).forEach(r => r.style.display = '');
                pageTxt.textContent = total === 0
                    ? 'No data avaiable'
                    : `Show ${start + 1}–${Math.min(start + perPage, total)} from ${total} data`;
                pageCtrl.innerHTML = '';

                function addPage(label, targetPage, opts = {}) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (opts.active ? ' active' : '') + (opts.disabled ? ' disabled' : '');
                    if (opts.disabled) {
                        li.innerHTML = `<span class="page-link">${label}</span>`;
                    } else {
                        li.innerHTML = `<a class="page-link" href="#">${label}</a>`;
                        li.addEventListener('click', e => { e.preventDefault(); currentPage = targetPage; render(); });
                    }
                    pageCtrl.appendChild(li);
                }

                addPage('Previous', currentPage - 1, { disabled: currentPage <= 1 });
                addPage('1', 1, { active: currentPage === 1 });
                if (currentPage > 3) addPage('...', null, { disabled: true });
                for (let p = Math.max(2, currentPage - 1); p <= Math.min(pages - 1, currentPage + 1); p++) {
                    addPage(String(p), p, { active: currentPage === p });
                }
                if (currentPage < pages - 2) addPage('...', null, { disabled: true });
                if (pages > 1) addPage(String(pages), pages, { active: currentPage === pages });
                addPage('Next', currentPage + 1, { disabled: currentPage >= pages });
            }

            customerSearch.addEventListener('input', () => {
                currentPage = 1;
                render();
            });
            resetBtn.addEventListener('click', () => {
                customerSearch.value = '';

                currentPage = 1;
                render();
            });
            table.querySelectorAll('th.sortable').forEach(th => {
                th.style.cursor = 'pointer';
                th.addEventListener('click', () => {
                    const col = parseInt(th.dataset.col);
                    if (sortCol === col) sortAsc = !sortAsc; else { sortCol = col; sortAsc = true; }
                    render();
                });
            });
            render();
        })();
    </script>
</body>

</html>