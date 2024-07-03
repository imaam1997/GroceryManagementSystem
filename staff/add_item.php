<!DOCTYPE html>
<html>
<head>
    <title>Add Grocery Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <!-- Add grocery item form -->
    <div class="container add-item-container">
        <h2>Add Grocery Item</h2>
        <form action="../php/add.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" required>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <label for="expiry">Expiry Date:</label>
            <input type="date" id="expiry" name="expiry" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <input type="submit" value="Add Item">
        </form>
        <div class="nav">
            <a href="../index.php">Home</a>
            <a href="display_inventory.php">View Inventory</a>
        </div>
    </div>
</body>
</html>
