<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $results = json_decode($_POST['results'], true);
    $buying_prices = json_decode($_POST['buying_prices'], true);

    // Set the headers to indicate a file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="calculated_prices.csv"');

    // Open the output stream
    $output = fopen('php://output', 'w');
    
    // Output the column headings
    fputcsv($output, ['Product', 'Buying Price', 'VAT Amount', 'General Expenses Amount', 'Profit Margin Amount', 'Selling Price']);

    // Output the data rows
    foreach ($results as $index => $result) {
        fputcsv($output, [
            'Product ' . ($index + 1),
            number_format($buying_prices[$index], 2),
            number_format($result['vat_amount'], 2),
            number_format($result['expenses_amount'], 2),
            number_format($result['profit_amount'], 2),
            number_format($result['selling_price'], 2),
        ]);
    }

    // Close the output stream
    fclose($output);
    exit();
} else {
    echo "Invalid request method.";
}
?>
