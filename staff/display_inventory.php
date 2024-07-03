<?php require_once '../php/data_handler.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
<div class="inventory-container">
    <h2>Grocery Inventory</h2>
    <div class="inventory-cards">
        <!-- Populate with product details from inventory in a card design -->
        <?php foreach ($data['groceryItems'] as $itemName): ?>
            <?php
            $itemDetails = isset($data['itemDetails'][$itemName]) ? $data['itemDetails'][$itemName] : array();
            $type = isset($itemDetails['type']) ? $itemDetails['type'] : '';
            $price = isset($itemDetails['price']) ? $itemDetails['price'] : '';
            $expiry = isset($itemDetails['expiry_date']) ? $itemDetails['expiry_date'] : '';
            $quantity = isset($itemDetails['quantity']) ? $itemDetails['quantity'] : '';
            $status = ($expiry < date("Y-m-d")) ? "Expired" : "Valid";
            $statusClass = strtolower($status);
            ?>
            <div class='card'>
                <h3><?php echo $itemName; ?></h3>
                <p>Type: <?php echo $type; ?></p>
                <p>Price: $<?php echo $price; ?></p>
                <p>Expiry: <?php echo $expiry; ?></p>
                <p>Quantity: <?php echo $quantity; ?></p>
                <!-- display item status on hover -->
                <div class="status <?php echo $statusClass; ?>"><?php echo $status; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="nav">
        <a href="staff_home.php">Home</a>
        <a href="add_item.php">Add Items</a>
    </div>
</div>
</body>
</html>
