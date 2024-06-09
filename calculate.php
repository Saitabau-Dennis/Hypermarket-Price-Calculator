<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buying_prices = $_POST['buying_price'];
    $vat = $_POST['vat'];
    $expenses = $_POST['expenses'];
    $profit_margin = $_POST['profit_margin'];
    
    function calculate_selling_price($buying_price, $vat, $expenses, $profit_margin) {
        $vat_amount = ($buying_price * $vat) / 100;
        $expenses_amount = ($buying_price * $expenses) / 100;
        $profit_amount = ($buying_price * $profit_margin) / 100;
        $selling_price = $buying_price + $vat_amount + $expenses_amount + $profit_amount;
        return [
            'vat_amount' => $vat_amount,
            'expenses_amount' => $expenses_amount,
            'profit_amount' => $profit_amount,
            'selling_price' => $selling_price
        ];
    }
    
    $results = [];
    foreach ($buying_prices as $buying_price) {
        $results[] = calculate_selling_price($buying_price, $vat, $expenses, $profit_margin);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculated Prices</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Calculated Prices</h1>
    <table>
        <tr>
            <th>Product</th>
            <th>Buying Price</th>
            <th>VAT Amount</th>
            <th>General Expenses Amount</th>
            <th>Profit Margin Amount</th>
            <th>Selling Price</th>
        </tr>
        <?php foreach ($results as $index => $result): ?>
            <tr>
                <td>Product <?= $index + 1 ?></td>
                <td><?= number_format($buying_prices[$index], 2) ?></td>
                <td><?= number_format($result['vat_amount'], 2) ?></td>
                <td><?= number_format($result['expenses_amount'], 2) ?></td>
                <td><?= number_format($result['profit_amount'], 2) ?></td>
                <td class="success"><?= number_format($result['selling_price'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="buttons">
        <form action="index.php" method="get">
            <input type="submit" value="Go Back">
        </form>
        <form action="export_csv.php" method="post">
            <input type="hidden" name="results" value='<?= json_encode($results) ?>'>
            <input type="hidden" name="buying_prices" value='<?= json_encode($buying_prices) ?>'>
            <input type="submit" value="Export CSV">
        </form>
    </div>
    <div class="spinner" id="spinner"></div>
    <script>
        document.querySelector('form[action="calculate.php"]').addEventListener('submit', function(e) {
            document.querySelector('input[type="submit"]').disabled = true;
            document.getElementById('spinner').style.display = 'block';
        });
    </script>
</body>
</html>
