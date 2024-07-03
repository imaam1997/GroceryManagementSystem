<?php
require_once 'data_handler.php';

// Retrieve form data
$name = $_POST["name"];
$quantity = $_POST["quantity"];

// Update item quantity
if (array_key_exists($name, $data['itemDetails'])) {
    $data['itemDetails'][$name]['quantity'] = $quantity;
}

// Save updated data to JSON file
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Redirect back to display_inventory.php after updating the quantity
header("Location: ../staff/display_inventory.php");
exit();
?>
