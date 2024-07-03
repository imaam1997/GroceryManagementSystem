<?php
require_once 'data_handler.php';

// Retrieve form data
$name = $_POST["name"];
$type = $_POST["type"];
$price = $_POST["price"];
$quantity = $_POST["quantity"];
$expiry = $_POST["expiry"];

// Add item name to groceryItems array if not already present
if (!in_array($name, $data['groceryItems'])) {
    $data['groceryItems'][] = $name;
}

// Add item details to itemDetails array
$data['itemDetails'][$name] = array(
    "type" => $type,
    "price" => $price,
    "quantity" => $quantity,
    "expiry_date" => $expiry
);

// Save updated data to JSON file
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Redirect back to display_inventory.php after adding the item
header("Location: ../staff/display_inventory.php");
exit();
?>
