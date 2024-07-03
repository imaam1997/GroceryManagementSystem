<?php
require_once 'data_handler.php';

// Retrieve item to delete
$itemNameToDelete = $_POST['deleteItem'];

// Find and remove item from data
if (($key = array_search($itemNameToDelete, $data['groceryItems'])) !== false) {
    unset($data['groceryItems'][$key]);
    unset($data['itemDetails'][$itemNameToDelete]);
}

// Re-index the array to ensure no gaps in the keys
$data['groceryItems'] = array_values($data['groceryItems']);

// Save updated data to JSON file
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Redirect back to display_inventory.php after deleting the item
header("Location: ../staff/display_inventory.php");
exit();
?>
