<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypermarket Price Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Hypermarket Price Calculator</h1>
    <form action="calculate.php" method="post">
        <h3>Buying Prices</h3>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="buying_price_<?= $i ?>">Product <?= $i ?>:</label>
            <input type="number" step="0.01" id="buying_price_<?= $i ?>" name="buying_price[]" required><br>
        <?php endfor; ?>
        <h3>General Details</h3>
        <label for="vat">VAT (%):</label>
        <input type="number" step="0.01" id="vat" name="vat" required><br>
        <label for="expenses">General Expenses (%):</label>
        <input type="number" step="0.01" id="expenses" name="expenses" required><br>
        <label for="profit_margin">Profit Margin (%):</label>
        <input type="number" step="0.01" id="profit_margin" name="profit_margin" required><br><br>
        <input type="submit" value="Calculate Prices">
    </form>
</body>
</html>
