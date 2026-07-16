<?php

// ============================
// DUMMY DATA - Report Tunggakan Customer
// ============================

$keyword_filter = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

$tunggakan = [
    ['customer' => 'Dewi Lestari', 'tanggal_invoice' => '2026-05-02', 'jatuh_tempo' => '2026-06-01', 'total_invoice' => 2100000, 'total_terbayar' => 1200000,],
    ['customer' => 'Rina Kusuma', 'tanggal_invoice' => '2026-05-10', 'jatuh_tempo' => '2026-06-09', 'total_invoice' => 950000, 'total_terbayar' => 650000,],
    ['customer' => 'Teguh Wibowo', 'tanggal_invoice' => '2026-04-18', 'jatuh_tempo' => '2026-05-18', 'total_invoice' => 4300000, 'total_terbayar' => 2900000,],
    ['customer' => 'Siti Rahayu', 'tanggal_invoice' => '2026-06-01', 'jatuh_tempo' => '2026-07-01', 'total_invoice' => 1450000, 'total_terbayar' => 450000,],
    ['customer' => 'Ahmad Fauzi', 'tanggal_invoice' => '2026-03-22', 'jatuh_tempo' => '2026-04-21', 'total_invoice' => 6200000, 'total_terbayar' => 3200000,],
    ['customer' => 'Nurul Hidayah', 'tanggal_invoice' => '2026-05-25', 'jatuh_tempo' => '2026-06-24', 'total_invoice' => 1500000, 'total_terbayar' => 750000,],
    ['customer' => 'Doni Setiawan', 'tanggal_invoice' => '2026-04-30', 'jatuh_tempo' => '2026-05-30', 'total_invoice' => 3000000, 'total_terbayar' => 1500000,],
    ['customer' => 'Laila Sari', 'tanggal_invoice' => '2026-06-10', 'jatuh_tempo' => '2026-07-10', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Tes', 'tanggal_invoice' => '2026-05-15', 'jatuh_tempo' => '2026-06-14', 'total_invoice' => 1800000, 'total_terbayar' => 600000,],
    ['customer' => 'Pria Kehidupan', 'tanggal_invoice' => '2026-05-16', 'jatuh_tempo' => '2026-06-15', 'total_invoice' => 1800000, 'total_terbayar' => 600000,],
    ['customer' => 'Bocil Kematian', 'tanggal_invoice' => '2026-05-17', 'jatuh_tempo' => '2026-06-16', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Ujang Ronda', 'tanggal_invoice' => '2026-05-18', 'jatuh_tempo' => '2026-06-17', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Jesko Gendeng', 'tanggal_invoice' => '2026-05-19', 'jatuh_tempo' => '2026-06-18', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Zidan Cihuy', 'tanggal_invoice' => '2026-05-20', 'jatuh_tempo' => '2026-06-19', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Gua Keren', 'tanggal_invoice' => '2026-05-21', 'jatuh_tempo' => '2026-06-20', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Bawakdehekwak', 'tanggal_invoice' => '2026-05-22', 'jatuh_tempo' => '2026-06-21', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Gokgokgok', 'tanggal_invoice' => '2026-05-23', 'jatuh_tempo' => '2026-06-22', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    ['customer' => 'Cihuyyyy', 'tanggal_invoice' => '2026-05-24', 'jatuh_tempo' => '2026-06-23', 'total_invoice' => 1800000, 'total_terbayar' => 450000,],
    // ['customer' => 'Budi Santoso', 'total_invoice' => 3850000, 'total_terbayar' => 3850000,],
    // ['customer' => 'Rizky Pratama', 'total_invoice' => 2100000, 'total_terbayar' => 2100000,],
    // ['customer' => 'Hendra Wijaya', 'total_invoice' => 4800000, 'total_terbayar' => 4800000,],
    // ['customer' => 'Fajar Nugroho', 'total_invoice' => 5600000, 'total_terbayar' => 5600000,],
    // ['customer' => 'Maya Anggraini', 'total_invoice' => 2250000, 'total_terbayar' => 2250000,],
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

        .progress {
            height: 6px;
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
        $activePage = 'arrears';
        include "../component/sidebar.php";
        ?>

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <!-- Page Header -->
                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3>Customer Overdue Report</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="dashboard.php"
                                            class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Overdue</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <!-- Filter -->
                    <div class="card">
                        <div class="card-header">

                            <!-- Baris Atas -->
                            <div class="d-flex justify-content-between align-items-center">

                                <!-- <div class="input-group input-group-sm" style="width:280px;">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="globalSearch" class="form-control" placeholder="Search">
                                </div> -->

                            </div>

                            <!-- Baris Filter -->
                            <div class="row g-2 align-items-end">

                                <div class="col-md-4">
                                    <label class="form-label">Keyword</label>
                                    <input type="text" id="customerSearch" class="form-control form-control-sm"
                                        placeholder="Customer...">
                                </div>

                                <!-- <div class="col-md-5">
                                    <label class="form-label">Status</label>
                                    <select id="statusFilter" class="form-select form-select-sm">
                                        <option value="">All</option>
                                        <option value="tunggakan">Outstanding balances only</option>
                                        <option value="lunas">Already paid</option>
                                    </select>
                                </div> -->

                                <div class="col-md-3 ms-auto">
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
                                                <th data-col="0">Customer</th>
                                                <th class="sortable" data-col="1">Invoice Date <i class="bi sort-icon"></i></th>
                                                <th class="sortable" data-col="2">Due Date <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="3">Total Invoice <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="4">Total Paid Off <i class="bi sort-icon"></i></th>
                                                <th class="sortable text-end" data-col="5">Rest of the bill <i class="bi sort-icon"></i></th>
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
                                                    <td data-sort="<?= strtotime($t['tanggal_invoice']) ?>">
                                                        <?= formatTanggal($t['tanggal_invoice']) ?>
                                                    </td>
                                                    <td data-sort="<?= strtotime($t['jatuh_tempo']) ?>">
                                                        <?= formatTanggal($t['jatuh_tempo']) ?>
                                                    </td>
                                                    <td class="text-end" data-sort="<?= $t['total_invoice'] ?>">
                                                        <?= rupiah($t['total_invoice']) ?>
                                                    </td>
                                                    <td class="text-end text-success" data-sort="<?= $t['total_terbayar'] ?>">
                                                        <?= rupiah($t['total_terbayar']) ?>
                                                    </td>
                                                    <td class="text-end fw-semibold <?= $lunas ? '' : 'text-danger' ?>"
                                                        data-sort="<?= $t['sisa_tagihan'] ?>">
                                                        <?= rupiah($t['sisa_tagihan']) ?>
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
        <?php include "../component/footer.php"; ?>
    </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        (function () {
            const table = document.getElementById('tabelTunggakan');
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

                    const customer = row.cells[0].textContent.toLowerCase();

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
            // globalSearch.addEventListener('input', () => {
            //     currentPage = 1;
            //     render();
            // });

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