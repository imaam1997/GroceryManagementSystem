<?php require_once '../php/data_handler.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Item Quantity</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<!-- Update Item Quantity -->
<body>
<div class="container update-item-container">
    <h2>Update Item Quantity</h2>
    <form action="../php/update_quantity.php" method="post">
        <label for="name">Name:</label>
        <select id="name" name="name" required>
            <option value="">Select Product</option>
            <!-- Populate with product names from inventory -->
            <?php foreach ($data['groceryItems'] as $itemName): ?>
                <option value="<?php echo $itemName; ?>"><?php echo $itemName; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <input type="submit" value="Update Quantity">
    </form>
    <div class="nav">
        <a href="staff_home.php">Home</a>
        <a href="display_inventory.php">View Inventory</a>
    </div>
</div>
</body>
</html>
