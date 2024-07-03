<?php
// Load sales data
$salesData = [];
if (file_exists('../php/sales.json')) {
    $salesData = json_decode(file_get_contents('../php/sales.json'), true);
}

$orderData = [];
if (file_exists('../php/order.json')) {
    $orderData = json_decode(file_get_contents('../php/order.json'), true);
}

// Calculate total number of orders
$totalOrders = count($orderData);

// Calculate total sales and total worth
$totalSales = 0;
$itemSales = [];
$orderTotal = [];

foreach ($orderData as $order) {
    $orderTotal[$order['name']] = 0;
    foreach ($order['items'] as $item) {
        $itemName = $item['name'];
        $itemQuantity = $item['quantity'];
        $itemPrice = isset($item['price']) ? $item['price'] : 0;
        $totalSales += $itemQuantity * $itemPrice;
        $orderTotal[$order['name']] += $itemQuantity * $itemPrice;
        if (!isset($itemSales[$itemName])) {
            $itemSales[$itemName] = [
                'quantity' => 0,
                'totalWorth' => 0
            ];
        }
        $itemSales[$itemName]['quantity'] += $itemQuantity;
        $itemSales[$itemName]['totalWorth'] += $itemQuantity * $itemPrice;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .card {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h3 {
            margin-top: 0;
        }
        .card table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .card th, .card td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .card th {
            background-color: #f2f2f2;
        }
        /* Button Styles */
.button {
    display: block;
    width: calc(100% - 20px);
    padding: 15px;
    margin: 10px auto;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.3s;
    box-sizing: border-box;
}

.button:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
}        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Sales Report</h2>
            <div class="total-sales">
                <div class="card">
                    <h3>Total Orders</h3>
                    <!-- Display total number of orders -->
                    <p><?php echo $totalOrders; ?></p>
                    <h3>Total Sales</h3>
                    <!-- Display total sales -->
                    <p>$<?php echo number_format($totalSales, 2); ?></p>
                </div>
            </div>
        </div>
        <div class="card">
            <h3>Sales for Each Item</h3>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity Sold</th>
                    <th>Total Worth</th>
                </tr>
                <!-- Loop through item sales data and display each item's sales -->
                <?php foreach ($itemSales as $itemName => $item): ?>
                    <tr>
                        <td><?php echo $itemName; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['totalWorth'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card">
            <h3>All Order Details</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Items Ordered</th>
                    <th>Order Total</th>
                </tr>
                <!-- Loop through all order data and display each order's details -->
                <?php foreach ($orderData as $order): ?>
                    <tr>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['address']; ?></td>
                        <td><?php echo $order['payment']; ?></td>
                        <td>
                            <!-- Display each item ordered within a table -->
                            <table>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>$<?php echo isset($item['price']) ? $item['price'] : ''; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                        <td>$<?php echo number_format($orderTotal[$order['name']], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- Link back to home page -->
        <a class="button" href="staff_home.php">Back to Home</a>
    </div>
</body>
</html>
