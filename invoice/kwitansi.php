<?php

// Dummy data — sambungin DB nanti
$no_invoice = $_GET['no_invoice'] ?? 'INV-001';
$customer   = $_GET['customer'] ?? 'Azura Mishimoto';

$invoiceItems = [
  ['name' => 'Laptop Asus VivoBook', 'qty' => 1, 'price' => 7500000],
  ['name' => 'Mouse Logitech Wireless', 'qty' => 2, 'price' => 150000],
];

$total = 0;
foreach ($invoiceItems as $item) {
  $total += $item['qty'] * $item['price'];
}

$no_kwitansi = 'KW-' . date('Ym') . '-' . str_pad((string) rand(1, 999), 3, '0', STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt <?= htmlspecialchars($no_kwitansi); ?></title>
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    .kwitansi-logo {
      font-size: 12px;
      color: var(--bs-secondary-color);
    }

    .kwitansi-title {
      text-align: center;
      font-size: 26px;
      margin: 10px 0 25px;
    }

    .kwitansi-meta {
      margin-bottom: 8px;
    }

    .kwitansi-meta .dots {
      border-bottom: 1px dotted var(--bs-border-color);
      display: inline-block;
      min-width: 60%;
    }

    table.kwitansi-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table.kwitansi-table th,
    table.kwitansi-table td {
      border: 1px solid var(--bs-border-color);
      padding: 8px 12px;
    }

    table.kwitansi-table th {
      text-align: left;
    }

    table.kwitansi-table td.center {
      text-align: center;
    }

    table.kwitansi-table td.right {
      text-align: right;
    }

    .kwitansi-footer {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .kwitansi-ttd {
      text-align: center;
    }

    .kwitansi-ttd .line {
      margin-top: 70px;
      border-top: 1px solid var(--bs-border-color);
      padding-top: 4px;
    }

    @media print {
      .app-sidebar, .app-header, .app-footer, .sidebar-overlay, #live-region, .d-print-none {
        display: none !important;
      }
      .app-main, .content-wrapper, .app-content {
        margin: 0 !important;
        padding: 0 !important;
      }
      .card {
        border: none !important;
        box-shadow: none !important;
      }
      body {
        background: #fff !important;
      }
      table.kwitansi-table th,
      table.kwitansi-table td {
        border-color: #000 !important;
      }
      @page {
        margin: 1.5cm;
      }
    }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary sidebar-collapse reduce-motion app-loaded">
  <div class="app-wrapper">

    <?php include "../itu diapain/header.php"; ?>
    <?php include "../itu diapain/sidebar.php"; ?>

    <div class="content-wrapper">
      <div class="app-content p-3">

        <div class="app-content-header d-print-none">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h4>Receipt</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="table.invoice.php">Invoice</a></li>
                  <li class="breadcrumb-item"><a href="invoice.php">See Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Receipt</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
        <div class="container-fluid mb-3 d-print-none">
          <button class="btn btn-primary" onclick="window.print()">
            <i class="bi bi-printer"></i> Print Receipt
          </button>
          <a href="invoice.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
          </a>
        </div>

        <div class="container-fluid">
          <div class="card">
            <div class="card-body kwitansi-box">

            <div class="kwitansi-logo">ArayaStore<br>Logo</div>
            <div class="kwitansi-title">Receipt</div>

            <div class="kwitansi-meta">Receipt Number: <span class="dots"><?= htmlspecialchars($no_kwitansi); ?></span></div>
            <div class="kwitansi-meta">Received from: <span class="dots"><?= htmlspecialchars($customer); ?></span></div>

            <table class="kwitansi-table">
              <thead>
                <tr>
                  <th style="width:60px;">Nomor</th>
                  <th>Product Details</th>
                  <th style="width:180px;">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($invoiceItems as $i => $item): ?>
                <tr>
                  <td class="center"><?= $i + 1; ?></td>
                  <td><?= htmlspecialchars($item['name']); ?> (<?= $item['qty']; ?>x)</td>
                  <td class="right">Rp <?= number_format($item['qty'] * $item['price'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                  <td><strong>TOTAL</strong></td>
                  <td></td>
                  <td class="right"><strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong></td>
                </tr>
              </tbody>
            </table>

            <div class="kwitansi-footer">
              <div><em>No. Invoice: <?= htmlspecialchars($no_invoice); ?></em></div>
              <div class="kwitansi-ttd">
                <div class="line">Signature<br>recipient of the money</div>
              </div>
            </div>

            </div>
          </div>
        </div>

        </div>

      </div>
    </div>

    <?php include "../itu diapain/footer.php"; ?>

  </div>
  <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>