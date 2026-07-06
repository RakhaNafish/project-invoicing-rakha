<?php

// Katalog item (dummy - sama dengan item/index.php)
$katalog = [
  ["id" => 1, "name" => "Laptop Asus VivoBook", "price" => 7500000],
  ["id" => 2, "name" => "Mouse Logitech Wireless", "price" => 150000],
  ["id" => 3, "name" => "Keyboard Mechanical", "price" => 450000],
  ["id" => 4, "name" => "Monitor LG 24 Inch", "price" => 1800000],
  ["id" => 5, "name" => "Headset Gaming", "price" => 350000],
  ["id" => 6, "name" => "Webcam Full HD", "price" => 500000],
  ["id" => 7, "name" => "Printer Epson L3210", "price" => 2200000],
  ["id" => 8, "name" => "Flashdisk 64GB", "price" => 90000],
  ["id" => 9, "name" => "Harddisk External 1TB", "price" => 800000],
  ["id" => 10, "name" => "SSD 512GB", "price" => 650000],
  ["id" => 11, "name" => "RAM 16GB DDR4", "price" => 700000],
  ["id" => 12, "name" => "Kabel HDMI", "price" => 75000],
  ["id" => 13, "name" => "Charger Laptop", "price" => 400000],
  ["id" => 14, "name" => "Cooling Fan Laptop", "price" => 250000],
  ["id" => 15, "name" => "Speaker Bluetooth", "price" => 300000],
  ["id" => 16, "name" => "Kamera Digital", "price" => 3500000],
  ["id" => 17, "name" => "Tablet Android", "price" => 2500000],
  ["id" => 18, "name" => "Smartphone Samsung", "price" => 4000000],
  ["id" => 19, "name" => "Power Bank 20000mAh", "price" => 250000],
  ["id" => 20, "name" => "Smartwatch", "price" => 900000],
  ["id" => 21, "name" => "Router WiFi", "price" => 450000],
  ["id" => 22, "name" => "LAN Cable 10M", "price" => 50000],
  ["id" => 23, "name" => "Microphone USB", "price" => 275000],
  ["id" => 24, "name" => "Projector Epson", "price" => 5200000],
  ["id" => 25, "name" => "UPS 650VA", "price" => 850000],
  ["id" => 26, "name" => "Graphic Tablet", "price" => 1200000],
  ["id" => 27, "name" => "USB Hub 4 Port", "price" => 95000],
  ["id" => 28, "name" => "Card Reader", "price" => 45000],
  ["id" => 29, "name" => "Scanner Canon", "price" => 1700000],
  ["id" => 30, "name" => "Mini PC", "price" => 4800000],
];

// Item yang ada di invoice ini
$invoiceItems = [
  ['name' => 'Laptop Asus VivoBook', 'qty' => 1, 'price' => 7500000],
  ['name' => 'Mouse Logitech Wireless', 'qty' => 2, 'price' => 150000],
];

$total = 0;
foreach ($invoiceItems as $item) {
  $total += $item['qty'] * $item['price'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Invoice</title>
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    @media print {
      .app-sidebar, .app-header, .app-footer, .sidebar-overlay, #live-region {
        display: none !important;
      }
      .app-main, .content-wrapper, .app-content {
        margin: 0 !important;
        padding: 0 !important;
      }
      .app-content-header {
        display: none !important;
      }
      .card {
        border: none !important;
        box-shadow: none !important;
      }
      body {
        background: #fff !important;
      }
      .badge, .table {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
      @page {
        margin: 1.2cm;
      }
    }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary sidebar-collapse reduce-motion app-loaded">
  <div class="app-wrapper">

    <?php include "../itu diapain/header.php"; ?>
    <?php include "../itu diapain/sidebar.php"; ?>

    <main class="app-main" id="main" tabindex="-1">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Invoice</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="table.invoice.php">Invoice</a></li>
                <li class="breadcrumb-item active" aria-current="page">See Invoice</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="app-content">
        <div class="container-fluid">

          <!-- Action bar -->
          <div class="d-flex justify-content-end gap-2 mb-3 d-print-none">
            <button class="btn btn-outline-secondary" onclick="window.print()">
              <i class="bi bi-printer me-1"></i> Print
            </button>
            <a href="#" class="btn btn-outline-secondary">
              <i class="bi bi-download me-1"></i> PDF
            </a>
            <a href="edit.php" class="btn btn-warning">
              <i class="bi bi-pencil-square"></i> Edit Invoice
            </a>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-brilliance"></i>
                Other
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#"><i class="bi bi-send me-1"></i> Send Invoice</a></li>
                <li><a class="dropdown-item" href="../dashboard/pembayaran.php?no_invoice=INV-001&customer=<?= urlencode('Azura Mishimoto') ?>&total=<?= $total ?>&from=invoice"><i class="bi bi-cash-coin"></i> Pay Now</a></li>
                <li><a class="dropdown-item" href="kwitansi.php?no_invoice=INV-001&customer=<?= urlencode('Azura Mishimoto') ?>&total=<?= $total ?>"><i class="bi bi-receipt"></i> Receipt</a></li>
              </ul>
            </div>
          </div>

          <div class="card">
            <div class="card-body p-4 p-md-5">

              <!-- Header -->
              <div class="row mb-4">
                <div class="col-sm-6">
                  <h2 class="h4 mb-0 text-primary fw-semibold">AdminLTE, Inc.</h2>
                  <p class="text-secondary mb-0 small">
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                  vwvwvwvw@email.com
                  </p>
                </div>
                <div class="col-sm-6 text-sm-end">
                  <h1 class="h2 mb-1">Invoice</h1>
                  <p class="text-secondary mb-0"><span class="fw-semibold">#</span>INV-001</p>
                  <span class="badge text-bg-warning mt-1">Pending</span>
                </div>
              </div>

              <!-- Billing details -->
              <div class="row mb-4">
                <div class="col-sm-6">
                  <p class="text-secondary small mb-1">Billed to</p>
                  <p class="mb-0 fw-semibold">Lobotomy Corporation</p>
                  <p class="text-secondary small mb-0">
                    Attn: Azura Mishimoto<br>
                    1234 Adalah Pokoknya<br>
                    Surabaya, Jawa Timur
                  </p>
                </div>
                <div class="col-sm-6 text-sm-end">
                  <p class="text-secondary small mb-1">Issue date</p>
                  <p class="mb-2">May 18, 2026</p>
                  <p class="text-secondary small mb-1">Due date</p>
                  <p class="mb-0">June 1, 2026</p>
                </div>
              </div>

              <!-- Items table -->
              <div class="table-responsive mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
                  <h5 class="mb-0">Items</h5>

                </div>
                <h5 class="mb-3 d-none d-print-block">Items</h5>
                <table class="table align-middle mb-0" id="itemsTable">
                  <thead>
                    <tr>
                      <th class="border-top-0">Description</th>
                      <th class="border-top-0 text-end" style="width:6rem">Qty</th>
                      <th class="border-top-0 text-end" style="width:9rem">Unit Price</th>
                      <th class="border-top-0 text-end" style="width:9rem">Amount</th>
                      <th class="border-top-0 text-center d-print-none" style="width:7rem">Action</th>
                    </tr>
                  </thead>
                  <tbody id="itemsBody">
                    <?php foreach ($invoiceItems as $i => $item): ?>
                      <tr data-index="<?= $i ?>">
                        <td>
                          <p class="mb-0 fw-semibold"><?= htmlspecialchars($item['name']) ?></p>
                        </td>
                        <td class="text-end"><?= $item['qty'] ?></td>
                        <td class="text-end">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($item['qty'] * $item['price'], 0, ',', '.') ?></td>
                        <td class="text-center d-print-none">
                          <button class="btn btn-warning btn-sm me-1" onclick="openEditModal(<?= $i ?>)" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" onclick="openDeleteModal(<?= $i ?>)" title="Hapus">
                            <i class="bi bi-trash3"></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <button class="btn btn-primary btn-sm d-print-none" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="bi bi-plus-lg"></i> Add Item
              </button>

              <!-- Totals -->
              <div class="row justify-content-end">
                <div class="col-md-5 col-lg-4">
                  <dl class="row mb-0">
                    <dt class="col-7 text-secondary fw-normal">Subtotal</dt>
                    <dd class="col-5 text-end mb-2" id="subtotalDisplay">Rp <?= number_format($total, 0, ',', '.') ?>
                    </dd>
                    <dt class="col-7 text-secondary fw-normal">Tax (0%)</dt>
                    <dd class="col-5 text-end mb-2">Rp 0</dd>
                    <dt class="col-7 fw-semibold border-top pt-2">Total due</dt>
                    <dd class="col-5 text-end fw-semibold border-top pt-2 mb-0" id="totalDisplay">Rp
                      <?= number_format($total, 0, ',', '.') ?>
                    </dd>
                  </dl>
                </div>
              </div>

              <hr class="my-4">
              <p class="text-secondary small mb-0">
                Thanks for your business. If you have any questions
                about this invoice, please contact <a href="mailto:rakhanafishrs@email.com">rakhanafishrs@email.com</a>.
              </p>

            </div>
          </div>
        </div>
      </div>
    </main>

    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">Anything you want</div>
      <strong>Copyright © 2014-2026&nbsp;<a href="https://adminlte.io"
          class="text-decoration-none">AdminLTE.io</a>.</strong>
      All rights reserved.
    </footer>
    <div class="sidebar-overlay"></div>
  </div>

  <!-- ===== MODAL: ADD ITEM ===== -->
  <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemModalLabel">
            <i class="bi bi-plus-circle me-2"></i>Add Item
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="addSelect" class="form-label fw-semibold">Nama Item <span class="text-danger">*</span></label>
            <select class="form-select" id="addSelect">
              <option value=""> Pilih item </option>
              <?php foreach ($katalog as $k): ?>
                <option value="<?= $k['id'] ?>" data-price="<?= $k['price'] ?>">
                  <?= htmlspecialchars($k['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback" id="addSelectError">Pilih item terlebih dahulu.</div>
          </div>

          <div class="mb-3">
            <label for="addQty" class="form-label fw-semibold">Qty <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="addQty" min="1" value="1">
            <div class="invalid-feedback">Qty minimal 1.</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Unit Price</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control bg-light text-secondary" id="addPriceDisplay" readonly
                placeholder="—">
            </div>
            <small class="text-secondary">Otomatis dari katalog.</small>
          </div>

          <div class="p-3 bg-light rounded">
            <div class="d-flex justify-content-between">
              <span class="text-secondary">Amount:</span>
              <span class="fw-semibold text-secondary" id="addPreviewAmount">Rp 0</span>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="saveAddItem()">
            <i class="bi bi-plus-lg me-1"></i>Tambah
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== MODAL: EDIT ITEM ===== -->
  <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editItemModalLabel">
            <i class="bi bi-pencil-square me-2"></i>Edit Item
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editIndex">

          <div class="mb-3">
            <label for="editSelect" class="form-label fw-semibold">Nama Item <span class="text-danger">*</span></label>
            <select class="form-select" id="editSelect">
              <option value="">-- Pilih item --</option>
              <?php foreach ($katalog as $k): ?>
                <option value="<?= $k['id'] ?>" data-price="<?= $k['price'] ?>">
                  <?= htmlspecialchars($k['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Pilih item terlebih dahulu.</div>
          </div>

          <div class="mb-3">
            <label for="editQty" class="form-label fw-semibold">Qty <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="editQty" min="1">
            <div class="invalid-feedback">Qty minimal 1.</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Unit Price</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control bg-light text-secondary" id="editPriceDisplay" readonly>
            </div>
            <small class="text-secondary">Otomatis dari katalog.</small>
          </div>

          <div class="p-3 bg-light rounded">
            <div class="d-flex justify-content-between">
              <span class="text-secondary">Amount:</span>
              <span class="fw-semibold" id="editPreviewAmount">Rp 0</span>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-warning" onclick="saveEditItem()">
            <i class="bi bi-check-lg me-1"></i>Simpan
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== MODAL: DELETE ITEM ===== -->
  <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center pt-0">
          <div class="mb-3"><i class="bi bi-trash3 text-danger" style="font-size:2.5rem"></i></div>
          <h5 class="mb-1">Hapus Item?</h5>
          <p class="text-secondary small mb-0" id="deleteItemName"></p>
        </div>
        <div class="modal-footer justify-content-center border-0 pt-0">
          <input type="hidden" id="deleteIndex">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
            <i class="bi bi-trash3 me-1"></i>Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="toast-container position-fixed top-0 end-0 p-3">

    <!-- Success -->
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body" id="successToastBody">
          Berhasil.
        </div>

        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
        </button>
      </div>
    </div>

    <!-- Delete -->
    <div id="deleteToast" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert">
      <div class="d-flex">
        <div class="toast-body" id="deleteToastBody">
          Item berhasil dihapus.
        </div>

        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
        </button>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>
  <script>
    // ── State ──────────────────────────────────────────────────────────────
    let invoiceItems = <?= json_encode(array_values($invoiceItems)) ?>;

    // katalog dari PHP → JS (untuk lookup nama+harga saat render)
    const katalog = <?= json_encode(array_values($katalog)) ?>;

    // ── Helpers ────────────────────────────────────────────────────────────
    function formatRp(n) {
      return 'Rp ' + n.toLocaleString('id-ID');
    }

    function escHtml(s) {
      const d = document.createElement('div');
      d.appendChild(document.createTextNode(s));
      return d.innerHTML;
    }

    function getPriceFromSelect(selectEl) {
      const opt = selectEl.options[selectEl.selectedIndex];
      return opt ? parseFloat(opt.dataset.price) || 0 : 0;
    }

    // ── Render ─────────────────────────────────────────────────────────────
    function renderTable() {
      const tbody = document.getElementById('itemsBody');
      tbody.innerHTML = '';
      invoiceItems.forEach(function (item, i) {
        const amount = item.qty * item.price;
        const tr = document.createElement('tr');
        tr.setAttribute('data-index', i);
        tr.innerHTML =
          '<td><p class="mb-0 fw-semibold">' + escHtml(item.name) + '</p></td>' +
          '<td class="text-end">' + item.qty + '</td>' +
          '<td class="text-end">' + formatRp(item.price) + '</td>' +
          '<td class="text-end">' + formatRp(amount) + '</td>' +
          '<td class="text-center d-print-none">' +
          '<button class="btn btn-warning btn-sm me-1" onclick="openEditModal(' + i + ')" title="Edit"><i class="bi bi-pencil-square"></i></button>' +
          '<button class="btn btn-danger btn-sm" onclick="openDeleteModal(' + i + ')" title="Hapus"><i class="bi bi-trash3"></i></button>' +
          '</td>';
        tbody.appendChild(tr);
      });
      recalcTotal();
    }

    function recalcTotal() {
      let total = 0;
      invoiceItems.forEach(function (item) { total += item.qty * item.price; });
      const fmt = formatRp(total);
      document.getElementById('subtotalDisplay').textContent = fmt;
      document.getElementById('totalDisplay').textContent = fmt;
    }

    // ── ADD ────────────────────────────────────────────────────────────────
    document.getElementById('addSelect').addEventListener('change', function () {
      const price = getPriceFromSelect(this);
      document.getElementById('addPriceDisplay').value = price ? price.toLocaleString('id-ID') : '';
      updateAddPreview();
    });

    document.getElementById('addQty').addEventListener('input', updateAddPreview);

    function updateAddPreview() {
      const price = getPriceFromSelect(document.getElementById('addSelect'));
      const qty = parseFloat(document.getElementById('addQty').value) || 0;
      document.getElementById('addPreviewAmount').textContent = formatRp(qty * price);
    }

    function saveAddItem() {
      const selEl = document.getElementById('addSelect');
      const qtyEl = document.getElementById('addQty');
      let valid = true;

      selEl.classList.remove('is-invalid');
      qtyEl.classList.remove('is-invalid');

      if (!selEl.value) { selEl.classList.add('is-invalid'); valid = false; }
      if (!qtyEl.value || qtyEl.value < 1) { qtyEl.classList.add('is-invalid'); valid = false; }
      if (!valid) return;

      const selectedOpt = selEl.options[selEl.selectedIndex];
      invoiceItems.push({
        name: selectedOpt.text,
        qty: parseInt(qtyEl.value),
        price: parseFloat(selectedOpt.dataset.price)
      });

      renderTable();

      // Reset
      selEl.value = '';
      qtyEl.value = 1;
      document.getElementById('addPriceDisplay').value = '';
      document.getElementById('addPreviewAmount').textContent = 'Rp 0';

      bootstrap.Modal.getInstance(document.getElementById('addItemModal')).hide();
      showSuccessToast("Item berhasil ditambahkan.");
    }

    // ── EDIT ───────────────────────────────────────────────────────────────
    function openEditModal(index) {
      const item = invoiceItems[index];
      document.getElementById('editIndex').value = index;
      document.getElementById('editQty').value = item.qty;

      // Cari option yang namanya cocok
      const selEl = document.getElementById('editSelect');
      selEl.value = '';
      for (let i = 0; i < selEl.options.length; i++) {
        if (selEl.options[i].text === item.name) {
          selEl.value = selEl.options[i].value;
          break;
        }
      }

      document.getElementById('editPriceDisplay').value = item.price.toLocaleString('id-ID');
      document.getElementById('editPreviewAmount').textContent = formatRp(item.qty * item.price);

      selEl.classList.remove('is-invalid');
      document.getElementById('editQty').classList.remove('is-invalid');

      new bootstrap.Modal(document.getElementById('editItemModal')).show();
    }

    document.getElementById('editSelect').addEventListener('change', function () {
      const price = getPriceFromSelect(this);
      document.getElementById('editPriceDisplay').value = price ? price.toLocaleString('id-ID') : '';
      updateEditPreview();
    });

    document.getElementById('editQty').addEventListener('input', updateEditPreview);

    function updateEditPreview() {
      const price = getPriceFromSelect(document.getElementById('editSelect'));
      const qty = parseFloat(document.getElementById('editQty').value) || 0;
      document.getElementById('editPreviewAmount').textContent = formatRp(qty * price);
    }

    function saveEditItem() {
      const index = parseInt(document.getElementById('editIndex').value);
      const selEl = document.getElementById('editSelect');
      const qtyEl = document.getElementById('editQty');
      let valid = true;

      selEl.classList.remove('is-invalid');
      qtyEl.classList.remove('is-invalid');

      if (!selEl.value) { selEl.classList.add('is-invalid'); valid = false; }
      if (!qtyEl.value || qtyEl.value < 1) { qtyEl.classList.add('is-invalid'); valid = false; }
      if (!valid) return;

      const selectedOpt = selEl.options[selEl.selectedIndex];
      invoiceItems[index] = {
        name: selectedOpt.text,
        qty: parseInt(qtyEl.value),
        price: parseFloat(selectedOpt.dataset.price)
      };

      renderTable();
      bootstrap.Modal.getInstance(document.getElementById('editItemModal')).hide();
      showSuccessToast("Item berhasil diperbarui.");
    }

    // ── DELETE ─────────────────────────────────────────────────────────────
    function openDeleteModal(index) {
      document.getElementById('deleteIndex').value = index;
      document.getElementById('deleteItemName').textContent = invoiceItems[index].name;
      new bootstrap.Modal(document.getElementById('deleteItemModal')).show();
    }

    function confirmDelete() {

      const index = parseInt(document.getElementById('deleteIndex').value);

      invoiceItems.splice(index, 1);

      renderTable();

      bootstrap.Modal.getInstance(
        document.getElementById('deleteItemModal')
      ).hide();

      showDeleteToast("Item berhasil dihapus.");

    }

    // ── AdminLTE sidebar scrollbars ────────────────────────────────────────
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
    document.addEventListener('DOMContentLoaded', function () {
      const sw = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll } });
      }
    });

    // ── Color Mode ─────────────────────────────────────────────────────────
    (() => {
      'use strict';
      const KEY = 'lte-theme';
      const get = () => localStorage.getItem(KEY);
      const set = (t) => localStorage.setItem(KEY, t);
      const dark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
      const preferred = () => get() || (dark() ? 'dark' : 'light');
      const apply = (t) => document.documentElement.setAttribute('data-bs-theme', t === 'auto' ? (dark() ? 'dark' : 'light') : t);
      apply(preferred());
      const sync = (t) => {
        document.querySelectorAll('[data-bs-theme-value]').forEach(el => {
          el.classList.toggle('active', el.getAttribute('data-bs-theme-value') === t);
          el.setAttribute('aria-pressed', el.getAttribute('data-bs-theme-value') === t);
          const c = el.querySelector('.bi-check-lg');
          if (c) c.classList.toggle('d-none', el.getAttribute('data-bs-theme-value') !== t);
        });
        document.querySelectorAll('[data-lte-theme-icon]').forEach(icon => {
          icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== t);
        });
      };
      globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => { if (!get() || get() === 'auto') apply(preferred()); });
      document.addEventListener('DOMContentLoaded', () => {
        sync(preferred());
        document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
          toggle.addEventListener('click', () => { const t = toggle.getAttribute('data-bs-theme-value'); set(t); apply(t); sync(t); });
        });
      });
    })();

    function showSuccessToast(message) {

      document.getElementById("successToastBody").textContent = message;

      bootstrap.Toast.getOrCreateInstance(
        document.getElementById("successToast")
      ).show();

    }

    function showDeleteToast(message) {

      document.getElementById("deleteToastBody").textContent = message;

      bootstrap.Toast.getOrCreateInstance(
        document.getElementById("deleteToast")
      ).show();

    }
  </script>

  <div id="live-region" class="live-region" aria-live="polite" aria-atomic="true" role="status"></div>
</body>

</html>