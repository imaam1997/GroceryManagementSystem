<?php
include '../php/data_handler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allowed = ['csv' => 'text/csv', 'json' => 'application/json', 'xml' => 'text/xml'];
    $maxsize = 5 * 1024 * 1024; // 5MB maximum file size
    $upload_dir = '../uploads/';
    $success_count = 0;
    $error_count = 0;
    $skipped_count = 0;
    $total_files = count($_FILES['files']['name']);

    for ($i = 0; $i < $total_files; $i++) {
        $filename = $_FILES['files']['name'][$i];
        $filetype = $_FILES['files']['type'][$i];
        $filesize = $_FILES['files']['size'][$i];
        $tmp_name = $_FILES['files']['tmp_name'][$i];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $error_count++;
            continue;
        }

        // Verify file size
        if ($filesize > $maxsize) {
            $error_count++;
            continue;
        }

        // Verify MIME type
        if (in_array($filetype, $allowed)) {
            $target_file = $upload_dir . basename($filename);

            // Check if file already exists
            if (file_exists($target_file)) {
                $skipped_count++;
                continue;
            } else {
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $success_count++;
                    try {
                        // Process the file here
                        process_file($target_file, $ext);
                    } catch (Exception $e) {
                        $error_count++;
                        echo "Error processing file: " . $e->getMessage() . "<br>";
                    }
                } else {
                    $error_count++;
                    echo "Error uploading file: $filename <br>";
                }
            }
        } else {
            $error_count++;
            echo "Unsupported file type: $filetype <br>";
        }
    }

    $message = "Upload Summary: <br> Successfully processed: $success_count <br> Skipped: $skipped_count <br> Errors: $error_count";
    echo $message;
} else {
    echo "No files were uploaded.";
}

function process_file($file, $ext) {
    switch ($ext) {
        case 'csv':
            $data = parse_csv($file);
            break;
        case 'json':
            $data = parse_json($file);
            break;
        case 'xml':
            $data = parse_xml($file);
            break;
        default:
            throw new Exception("Unsupported file format.");
    }

    foreach ($data as $record) {
        if (validate_record($record)) {
            upload($record);
        } else {
            echo "Invalid record structure found.<br>";
        }
    }
}

function validate_record($record) {
    return isset($record['name'], $record['type'], $record['price'], $record['quantity'], $record['expiry_date']);
}

function parse_csv($file) {
    $csvData = array_map('str_getcsv', file($file));
    $header = array_shift($csvData); // Remove and store the header row

    $formattedData = [];
    foreach ($csvData as $row) {
        $formattedData[] = [
            'name' => isset($row[0]) ? $row[0] : '',
            'type' => isset($row[1]) ? $row[1] : '',
            'price' => isset($row[2]) ? $row[2] : '',
            'quantity' => isset($row[3]) ? $row[3] : '',
            'expiry_date' => isset($row[4]) ? $row[4] : ''
        ];
    }

    return $formattedData;
}

function parse_json($file) {
    $jsonData = file_get_contents($file);
    $data = json_decode($jsonData, true);
    return $data['products']; 
}

function parse_xml($file) {
    $xml = simplexml_load_file($file);
    $json = json_encode($xml);
    $data = json_decode($json, true);
    return $data['product']; 
}

function upload($record) {
    global $data, $dataFile;

    $name = $record['name'];
    $type = $record['type'];
    $price = $record['price'];
    $quantity = $record['quantity'];
    $expiry_date = $record['expiry_date'];

    $data['groceryItems'][] = $name;
    $data['itemDetails'][$name] = [
        'type' => $type,
        'price' => $price,
        'quantity' => $quantity,
        'expiry_date' => $expiry_date
    ];

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
}
?>
