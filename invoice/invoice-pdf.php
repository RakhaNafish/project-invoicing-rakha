<?php
require '../vendor/autoload.php'; // sesuaikan path ke vendor/autoload.php

use Dompdf\Dompdf;
use Dompdf\Options;

// ── Data (sama dengan invoice.php) ──────────────────────────────────────
$invoiceItems = [
  ['name' => 'Laptop Asus VivoBook', 'qty' => 1, 'price' => 7500000],
  ['name' => 'Mouse Logitech Wireless', 'qty' => 2, 'price' => 150000],
];

$total = 0;
foreach ($invoiceItems as $item) {
  $total += $item['qty'] * $item['price'];
}

$noInvoice = $_GET['no_invoice'] ?? 'INV-001';
$customer  = $_GET['customer'] ?? 'Azura Mishimoto';

function rp($n) {
  return 'Rp ' . number_format($n, 0, ',', '.');
}

// ── Build HTML ───────────────────────────────────────────────────────────
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
  h1 { font-size: 20px; margin-bottom: 0; }
  h2 { font-size: 15px; color: #4b6bfb; margin: 0; }
  .text-end { text-align: right; }
  .text-secondary { color: #6c757d; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; }
  th, td { padding: 6px 4px; }
  thead th { border-bottom: 2px solid #dee2e6; text-align: left; }
  thead th.text-end { text-align: right; }
  tbody td { border-bottom: 1px solid #eee; }
  .totals { width: 40%; float: right; margin-top: 15px; }
  .totals td { padding: 4px; }
  .totals .grand { font-weight: bold; border-top: 1px solid #333; }
  .header-row:after { content: ""; display: table; clear: both; }
  .col-left { width: 55%; float: left; }
  .col-right { width: 45%; float: left; text-align: right; }
  .badge { background: #ffc107; padding: 2px 8px; border-radius: 3px; font-size: 11px; }
</style>
</head>
<body>

  <div class="header-row">
    <div class="col-left">
      <h2>Araya Store</h2>
      <p class="text-secondary">
        Jl. Diponegoro<br>
        azura@gmail.com
      </p>
    </div>
    <div class="col-right">
      <h1>Invoice</h1>
      <p><strong>#</strong><?= htmlspecialchars($noInvoice) ?></p>
      <span class="badge">Pending</span>
    </div>
  </div>

  <div class="header-row">
    <div class="col-left">
      <p class="text-secondary">Billed to</p>
      <p><strong>Lobotomy Corporation</strong><br>
      Attn: <?= htmlspecialchars($customer) ?><br>
      1234 Adalah Pokoknya<br>
      Surabaya, Jawa Timur</p>
    </div>
    <div class="col-right">
      <p class="text-secondary">Issue date</p>
      <p>May 18, 2026</p>
      <p class="text-secondary">Due date</p>
      <p>June 1, 2026</p>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th class="text-end">Qty</th>
        <th class="text-end">Unit Price</th>
        <th class="text-end">Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($invoiceItems as $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['name']) ?></td>
          <td class="text-end"><?= $item['qty'] ?></td>
          <td class="text-end"><?= rp($item['price']) ?></td>
          <td class="text-end"><?= rp($item['qty'] * $item['price']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <table class="totals">
    <tr><td>Subtotal</td><td class="text-end"><?= rp($total) ?></td></tr>
    <tr><td>Tax (0%)</td><td class="text-end">Rp 0</td></tr>
    <tr class="grand"><td>Total due</td><td class="text-end"><?= rp($total) ?></td></tr>
  </table>

  <div style="clear:both; margin-top:40px; font-size:11px; color:#6c757d;">
    Thanks for your business. Questions → rakhanafishrs@email.com
  </div>

</body>
</html>
<?php
$html = ob_get_clean();

// ── Generate PDF ─────────────────────────────────────────────────────────
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("invoice-{$noInvoice}.pdf", ["Attachment" => true]);