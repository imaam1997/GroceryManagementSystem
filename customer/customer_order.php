<!DOCTYPE html>
<html>
<head>
    <title>Place Order - Grocery Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Container Styles */
        .container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 40px 30px;
            transition: transform 0.3s ease-in-out;
            box-sizing: border-box;
            text-align: center; 
        }

        .container:hover {
            transform: translateY(-10px);
        }

        .add-item-container {
            width: 450px;
            text-align: center;
        }

        /* Heading Styles */
        h2 {
            color: #343a40;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Form and Input Styles */
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            text-align: left; 
        }

        input[type="text"], input[type="number"], input[type="date"], input[type="submit"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
            resize: vertical; 
            height: auto; 
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            margin: 20px auto 0;
        }

        input[type="submit"]:hover {
            background-color: #218838;
            transform: translateY(-5px);
        }

        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            appearance: none;
            background-color: #fff; 
        }

        select:hover {
            border-color: #007bff; 
        }

        /* Navigation Styles */
        .nav {
            text-align: center;
            margin-top: 20px;
        }

        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #0056b3;
        }

        /* Radio Button Styles */
        .radio-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
        }

        .radio-group div {
            display: flex;
            align-items: center;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        .radio-group label {
            margin-top: 8px;
            font-weight: bold;
            color: #555;
        }

        /* Logout Button */
        .logout {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 20px; 
        }

        .logout:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container add-item-container">
        <h2>Place Your Order</h2>
        <form action="select_quantities.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            <!-- Populate dropdown menu -->
            <h3>Select Items:</h3>
            <select id="items" name="items[]" multiple="multiple" style="width: 100%;" required>
                <?php
                require_once '../php/data_handler.php';
                foreach ($data['groceryItems'] as $itemName):
                    $itemDetails = $data['itemDetails'][$itemName] ?? array();
                    $price = $itemDetails['price'] ?? '';
                ?>
                <option value="<?php echo $itemName; ?>"><?php echo "$itemName ($$price)"; ?></option>
                <?php endforeach; ?>
            </select>

            <h3>Payment Method:</h3>
            <div class="radio-group">
                <div>
                    <input type="radio" id="credit" name="payment" value="Credit" required>
                    <label for="credit">Credit Card</label>
                </div>
                <div>
                    <input type="radio" id="debit" name="payment" value="Debit">
                    <label for="debit">Debit Card</label>
                </div>
                <div>
                    <input type="radio" id="cash" name="payment" value="Cash">
                    <label for="cash">Cash</label>
                </div>
            </div>
            
            <input type="submit" value="Next">
        </form>
        <div class="nav">
        <a href="customer_home.php">Home</a>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#items').select2({
                placeholder: "Select items",
                allowClear: true
            });
        });
    </script>

    
</body>
</html>
