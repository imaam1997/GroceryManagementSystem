<?php
// Define the data file path
$dataFile = __DIR__ . '/inventory.json';

// Check if the file exists, if not create it
if (!file_exists($dataFile)) {
    $initialData = json_encode(['groceryItems' => [], 'itemDetails' => []], JSON_PRETTY_PRINT);
    file_put_contents($dataFile, $initialData);
}

// Load existing data
$data = json_decode(file_get_contents($dataFile), true);

// Check if the necessary keys exist and initialize them if not
if (!isset($data['groceryItems'])) {
    $data['groceryItems'] = [];
}

if (!isset($data['itemDetails'])) {
    $data['itemDetails'] = [];
}

// Function to get item details by name
function getItemDetails($itemName, $itemDetails) {
    return $itemDetails[$itemName];
}
?>
