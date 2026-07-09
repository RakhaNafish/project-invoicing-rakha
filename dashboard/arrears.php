<?php

// ============================
// DUMMY DATA - Report Tunggakan Customer
// ============================

$keyword_filter = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$tunggakan = [
    ['customer' => 'Dewi Lestari', 'total_invoice' => 2100000, 'total_terbayar' => 1200000,],
    ['customer' => 'Rina Kusuma', 'total_invoice' => 950000, 'total_terbayar' => 650000,],
    ['customer' => 'Teguh Wibowo', 'total_invoice' => 4300000, 'total_terbayar' => 2900000,],
    ['customer' => 'Budi Santoso', 'total_invoice' => 3850000, 'total_terbayar' => 3850000,],
    ['customer' => 'Siti Rahayu', 'total_invoice' => 1450000, 'total_terbayar' => 450000,],
    ['customer' => 'Ahmad Fauzi', 'total_invoice' => 6200000, 'total_terbayar' => 3200000,],
    ['customer' => 'Rizky Pratama', 'total_invoice' => 2100000, 'total_terbayar' => 2100000,],
    ['customer' => 'Nurul Hidayah', 'total_invoice' => 1500000, 'total_terbayar' => 750000,],
    ['customer' => 'Hendra Wijaya', 'total_invoice' => 4800000, 'total_terbayar' => 4800000,],
    ['customer' => 'Doni Setiawan', 'total_invoice' => 3000000, 'total_terbayar' => 1500000,],
    ['customer' => 'Maya Anggraini', 'total_invoice' => 2250000, 'total_terbayar' => 2250000,],
    ['customer' => 'Fajar Nugroho', 'total_invoice' => 5600000, 'total_terbayar' => 5600000,],
    ['customer' => 'Laila Sari', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
];

// Hitung sisa tagihan
foreach ($tunggakan as &$t) {
    $t['sisa_tagihan'] = $t['total_invoice'] - $t['total_terbayar'];
}
unset($t);

// Urutkan dari sisa tagihan terbesar
usort($tunggakan, fn($a, $b) => $b['sisa_tagihan'] <=> $a['sisa_tagihan']);

$jumlah_customer_nunggak = count(array_filter($tunggakan, fn($t) => $t['sisa_tagihan'] > 0));

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

        .progress {
            height: 6px;
        }
    </style>
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../itu diapain/header.php"; ?>
        <?php
        $activePage = 'arrears';
        include "../itu diapain/sidebar.php";
        ?>

        <div class="content-wrapper">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header px-3 pt-3">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3>Customer Overdue Report</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Overdue</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter -->
                <div class="card">
                    <div class="card-header">

                        <!-- Baris Atas -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="input-group input-group-sm" style="width:280px;">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="globalSearch" class="form-control" placeholder="Search">
                            </div>

                        </div>

                        <!-- Baris Filter -->
                        <div class="row g-2 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label">Keyword</label>
                                <input type="text" id="customerSearch" class="form-control form-control-sm"
                                    placeholder="Customer...">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Status</label>
                                <select id="statusFilter" class="form-select form-select-sm">
                                    <option value="">All</option>
                                    <option value="tunggakan">Outstanding balances only</option>
                                    <option value="lunas">Already paid</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <button type="button" id="resetFilterBtn" class="btn btn-secondary btn-sm w-100">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                    Reset Filter
                                </button>
                            </div>

                        </div>

                    </div>

                    <?php if (count($tunggakan) > 0): ?>

                        <!-- Tabel Tunggakan -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Overdue Details by Customer</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle" id="tabelTunggakan">
                                    <thead>
                                        <tr>
                                            <th class="sortable" data-col="0">Customer</th>
                                            <th class="sortable text-end" data-col="1">Total Paid Off</th>
                                            <th class="sortable text-end" data-col="2">Rest of the bill</th>
                                            <th class="sortable text-end" data-col="3">Total Invoice</th>
                                            <th class="text-center" style="width:100px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tunggakan as $t):
                                            $pct = $t['total_invoice'] > 0
                                                ? round(($t['total_terbayar'] / $t['total_invoice']) * 100)
                                                : 0;
                                            $lunas = $t['sisa_tagihan'] <= 0;
                                            ?>
                                            <tr data-status="<?= $lunas ? 'lunas' : 'tunggakan' ?>">
                                                <td class="fw-semibold"><?= htmlspecialchars($t['customer']) ?></td>
                                                <td class="text-end text-success"><?= rupiah($t['total_terbayar']) ?></td>
                                                <td class="text-end fw-semibold <?= $lunas ? '' : 'text-danger' ?>">
                                                    <?= rupiah($t['sisa_tagihan']) ?>
                                                </td>
                                                <td class="text-end"><?= rupiah($t['total_invoice']) ?></td>
                                                <td class="text-center">
                                                    <span class="badge <?= $lunas ? 'text-bg-success' : 'text-bg-danger' ?>">
                                                        <?= $lunas ? 'Paid' : 'To Be Overdue' ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="small text-muted">Show</span>
                                    <select id="showEntries" class="form-select form-select-sm w-auto">
                                        <option value="5">5</option>
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    <span id="paginationText" class="small text-muted"></span>
                                </div>
                                <ul class="pagination pagination-sm mb-0" id="paginationControls"></ul>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="card">
                    <div class="card-body empty-state">
                        <i class="bi bi-inbox d-block"></i>
                        <p class="mb-0">Tidak ada data customer yang cocok dengan pencarian.</p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    </div>

    <?php include "../itu diapain/footer.php"; ?>
    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        (function () {
            const table = document.getElementById('tabelTunggakan');
            if (!table) return;
            const tbody = table.querySelector('tbody');
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const globalSearch = document.getElementById('globalSearch');
            const customerSearch = document.getElementById('customerSearch');
            const statusEl = document.getElementById('statusFilter');
            const showEl = document.getElementById('showEntries');
            const resetBtn = document.getElementById('resetFilterBtn');
            const pageCtrl = document.getElementById('paginationControls');
            const pageTxt = document.getElementById('paginationText');
            let sortCol = -1, sortAsc = true, currentPage = 1;

            function filterRows() {

                const globalKeyword = globalSearch.value.toLowerCase();
                const customerKeyword = customerSearch.value.toLowerCase();
                const status = statusEl.value;

                return allRows.filter(row => {

                    const allText = row.textContent.toLowerCase();

                    const customer = row.cells[0].textContent.toLowerCase();

                    const matchGlobal =
                        !globalKeyword ||
                        allText.includes(globalKeyword);

                    const matchCustomer =
                        !customerKeyword ||
                        customer.includes(customerKeyword);

                    const matchStatus =
                        !status ||
                        row.dataset.status === status;

                    return matchGlobal && matchCustomer && matchStatus;

                });

            }
            function sortRows(rows) {
                if (sortCol < 0) return rows;
                return [...rows].sort((a, b) => {
                    const av = a.cells[sortCol]?.textContent.trim() || '';
                    const bv = b.cells[sortCol]?.textContent.trim() || '';
                    const an = parseFloat(av.replace(/[^\d]/g, ''));
                    const bn = parseFloat(bv.replace(/[^\d]/g, ''));
                    const cmp = !isNaN(an) && !isNaN(bn) ? an - bn : av.localeCompare(bv, 'id');
                    return sortAsc ? cmp : -cmp;
                });
            }
            function render() {
                const filtered = sortRows(filterRows());
                const perPage = parseInt(showEl.value);
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
            globalSearch.addEventListener('input', () => {
                currentPage = 1;
                render();
            });

            customerSearch.addEventListener('input', () => {
                currentPage = 1;
                render();
            });
            statusEl.addEventListener('change', () => { currentPage = 1; render(); });
            showEl.addEventListener('change', () => { currentPage = 1; render(); });
            resetBtn.addEventListener('click', () => {
                globalSearch.value = '';
                customerSearch.value = '';
                statusEl.value = '';
                showEl.value = '10';

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