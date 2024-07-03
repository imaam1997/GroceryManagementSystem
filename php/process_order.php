<?php
require_once '../php/data_handler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $quantities = $_POST['quantities'];
    $payment = $_POST['payment'];

    // Initialize order summary
    $orderSummary = [
        'name' => $name,
        'address' => $address,
        'payment' => $payment,
        'items' => []
    ];

    // Load inventory data
    $data = [];
    if (file_exists('../php/inventory.json')) {
        $data = json_decode(file_get_contents('../php/inventory.json'), true);
    } else {
        // Create inventory file if not exist
        file_put_contents('../php/inventory.json', json_encode([], JSON_PRETTY_PRINT));
    }

    // Load sales data
    $salesData = [];
    if (file_exists('../php/sales.json')) {
        $salesData = json_decode(file_get_contents('../php/sales.json'), true);
    } else {
        // Create sales file if not exist
        file_put_contents('../php/sales.json', json_encode([], JSON_PRETTY_PRINT));
    }

    $alert = false; // Flag to track if there's an alert

    foreach ($quantities as $itemName => $quantity) {
        if (array_key_exists($itemName, $data['itemDetails'])) {
            $itemDetails = $data['itemDetails'][$itemName];
            $availableQuantity = $itemDetails['quantity'];
            if ($availableQuantity >= $quantity) {
                // Update inventory
                $data['itemDetails'][$itemName]['quantity'] -= $quantity;
                // Update or create entry in sales data
                if (array_key_exists($itemName, $salesData)) {
                    $salesData[$itemName]['quantity'] += $quantity;
                } else {
                    $salesData[$itemName] = [
                        'name' => $itemName,
                        'quantity' => $quantity
                    ];
                }
                // Add item to order summary
                $orderSummary['items'][] = [
                    'name' => $itemName,
                    'quantity' => $quantity,
                    'price' => $itemDetails['price']
                ];
            } else {
                // Not enough stock for the item
                $alert = true; 
            }
        }
    }

    if ($alert) {
        // Display alert
        echo "<script>alert('Not enough stock for some items. Please adjust your order.')</script>";
        // Redirect to order page
        echo "<script>window.location.href = '../customer/order_page.php';</script>";
        exit;
    } else {
        // Save updated inventory
        file_put_contents('../php/inventory.json', json_encode($data, JSON_PRETTY_PRINT));
        // Append order details to the existing file
        $existingOrders = [];
        if (file_exists('../php/order.json')) {
            $existingOrders = json_decode(file_get_contents('../php/order.json'), true);
        }
        $existingOrders[] = $orderSummary;
        file_put_contents('../php/order.json', json_encode($existingOrders, JSON_PRETTY_PRINT));
        // Save sales data
        file_put_contents('../php/sales.json', json_encode($salesData, JSON_PRETTY_PRINT));

        // Display order summary
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Order Summary</title>";
        echo "<link rel='stylesheet' href='../css/styles.css'>";        
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<div class='order-summary'>";
        echo "<h2>Order Summary</h2>";
        echo "<p><strong>Name:</strong> {$orderSummary['name']}</p>";
        echo "<p><strong>Address:</strong> {$orderSummary['address']}</p>";
        echo "<p><strong>Payment Method:</strong> {$orderSummary['payment']}</p>";
        echo "<h3>Items Ordered:</h3>";
        echo "<ul>";
        foreach ($orderSummary['items'] as $item) {
            echo "<li>{$item['name']} - Quantity: {$item['quantity']}, Price: \${$item['price']}</li>";
        }
        echo "</ul>";
        echo "<a class='button' href='../customer/customer_home.php'>Back to Home</a>";
        echo "</div>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
} else {
    echo "<p class='error'>Invalid request.</p>";
}
?>
