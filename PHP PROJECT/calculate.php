<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $buying_prices = $_POST['buying_price'];
    $vat = floatval($_POST['vat']);
    $general_expenses = floatval($_POST['general_expenses']);
    $profit_margin = floatval($_POST['profit_margin']);

    // Initialize arrays to hold results
    $vat_amounts = [];
    $general_expenses_amounts = [];
    $profit_margin_amounts = [];
    $selling_prices = [];

    // Perform calculations for each product
    foreach ($buying_prices as $price) {
        $vat_amount = $price * ($vat / 100);
        $general_expenses_amount = $price * ($general_expenses / 100);
        $profit_margin_amount = $price * ($profit_margin / 100);
        $selling_price = $price + $vat_amount + $general_expenses_amount + $profit_margin_amount;

        // Store results
        $vat_amounts[] = $vat_amount;
        $general_expenses_amounts[] = $general_expenses_amount;
        $profit_margin_amounts[] = $profit_margin_amount;
        $selling_prices[] = $selling_price;
    }

    // Display the results
    echo "<h1>Calculation Results</h1>";
    echo "<table border='1'>
            <tr>
                <th>Product</th>
                <th>Buying Price</th>
                <th>VAT</th>
                <th>General Expenses</th>
                <th>Profit Margin</th>
                <th>Selling Price</th>
            </tr>";
    for ($i = 0; $i < count($buying_prices); $i++) {
        echo "<tr>
                <td>Product " . ($i + 1) . "</td>
                <td>" . number_format($buying_prices[$i], 2) . "</td>
                <td>" . number_format($vat_amounts[$i], 2) . "</td>
                <td>" . number_format($general_expenses_amounts[$i], 2) . "</td>
                <td>" . number_format($profit_margin_amounts[$i], 2) . "</td>
                <td>" . number_format($selling_prices[$i], 2) . "</td>
              </tr>";
    }
    echo "</table>";
}

