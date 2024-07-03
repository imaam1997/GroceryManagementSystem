# Grocery Management System

This is a simple Grocery Management System that allows customers to place orders and staff to manage the inventory and view sales reports.

## Usage

### Homepage

**URL:** `http://localhost/Lab3/index.php`

1. **Navigate to Homepage:**
   - Open a web browser.
   - Go to `http://localhost/Lab3/index.php`.

2. **Select User Type:**
   - You will see the homepage with two options:
     - **Customer**: Click the "Customer" button to access the customer portal.
     - **Staff**: Click the "Staff" button to access the staff portal.

### Staff Functions

#### Add Item

1. **Navigate to Add Item Page:**
   - Click the "Add Item" button on the staff homepage.

2. **Fill in the Form:**
   - Enter the name, type, price, quantity, and expiry date of the item.
   - Click the "Add Item" button.

3. **Confirmation:**
   - You will be redirected to the inventory display page.
   - The newly added item will appear in the inventory list.

#### Update Item

1. **Navigate to Update Item Page:**
   - Click the "Update Item" button on the staff homepage.

2. **Select Item to Update:**
   - From the dropdown menu, select the item you want to update.

3. **Update Quantity:**
   - Enter the new quantity for the selected item.
   - Click the "Update Quantity" button.

4. **Confirmation:**
   - You will be redirected to the inventory display page.
   - The quantity of the selected item will be updated.

#### View Inventory

1. **Navigate to Inventory Display Page:**
   - Click the "View Inventory" button on the staff homepage.

2. **Inventory Display:**
   - You will see a list of all items in the inventory.
   - Each item will display its name, type, price, quantity, and expiry date.

#### Display Sales Report

1. **Navigate to Sales Report Page:**
   - Click the "Sales Report" button on the staff homepage.

2. **Generate Sales Report:**
   - The sales report will be displayed, showing the total quantity sold for each item and all order details.

### Customer Function

#### Place Order

1. **Navigate to Order Page:**
   - Click the "Place Order" button on the customer homepage.

2. **Fill in the Order Form:**
   - Enter your name and address.
   - Select the items you want to order from the dropdown menu.
   - Choose the payment method (Credit Card, Debit Card, or Cash).
   - Click the "Next" button.

3. **Select Quantities:**
   - On the next page, select the quantity for each item.
   - Click the "Submit Order" button.

4. **Confirmation:**
   - You will see an order summary with the details of your order.
   - The inventory will be updated based on your order.


PHP Folder
add.php
This file handles the addition of a new item to the inventory.
It retrieves form data submitted by the user, including the item name, type, price, quantity, and expiry date.
Checks if the item name already exists in the inventory. If not, it adds the item name to the list of grocery items.
Adds the item details to the itemDetails array.
Saves the updated data to the JSON file.
Finally, it redirects back to the inventory display page after adding the item.
data_handler.php
This file contains functions and data related to handling the inventory data.
It defines the data file path and checks if the file exists. If not, it creates it with initial data.
Loads existing data from the JSON file.
Initializes the necessary keys if they do not exist in the data array.
Defines a function getItemDetails() to retrieve item details by name.
process_order.php
This file processes the order placed by a customer.
Retrieves form data submitted by the user, including the customer name, address, quantities of items, and payment method.
Loads inventory and sales data from JSON files.
Iterates over the selected items and checks if there is enough stock for each item.
Updates the inventory and sales data accordingly.
Displays an alert if there is not enough stock for some items and redirects back to the order page.
If all items are available, it updates the inventory, appends the order details to the existing order file, and saves the sales data.
Finally, it displays the order summary to the customer.
update_quantity.php
This file handles the update of item quantity in the inventory.
Retrieves form data submitted by the user, including the item name and updated quantity.
Updates the item quantity in the itemDetails array.
Saves the updated data to the JSON file.
Redirects back to the inventory display page after updating the quantity.
Customer Folder
customer_home.php
This file is the homepage for customers.
It provides a link to the "Place Order" page and a logout option.
customer_order.php
This file allows customers to place orders.
It displays a form where customers can enter their name, address, select items to order, and choose a payment method.
The "Next" button takes them to the next page to select item quantities.
select_quantities.php
This file displays a form where customers can select quantities for the items they want to order.
After selecting quantities and clicking the "Submit Order" button, the order is processed.