<?php
// Include autoloader 
require_once 'vendor/autoload.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
if (isset($_POST["print_order"])) {
    include "config.php";
    $order_id = $_POST["order"];
    $query = mysqli_query($db, "SELECT * FROM orders WHERE id = '$order_id'");
    $data = mysqli_fetch_assoc($query);

    $date = date("Y/m/d");
    $name = $data['u_name'];
    $address = $data['u_address'];
    $tracking = $data['tracking_no'];
    $phone = $data['u_phone'];
    $country = $data['u_country'];
    $pay_mode = $data['delivery_status'];
    $p_name = $data['p_name'];
    $p_quantity = $data['p_quantity'];
    $p_price = $data['p_price'];
    $amount = $p_price * $p_quantity;
    $tax = $amount * 0.18;
    $total = $amount + $tax;
    $html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>K-Medicos Receipt</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #fffff;
    color: #333;
    margin: 0;
    padding: 0;
}

.receipt-container {
    width: 80%;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header {
    text-align: center;
    margin-bottom: 20px;
    background-color: green;
    color: #fff;
    padding: 10px;
    border-radius: 8px;
}

header h1 {
    margin: 0;
    font-size: 28px;
}

header p {
    margin: 5px 0;
    font-size: 14px;
}

.receipt-body h2 {
    text-align: center;
    font-size: 24px;
    color: green;
    margin-bottom: 20px;
}

.details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.customer-details, .transaction-details {
    width: 45%;
}

h3 {
    margin-top: 0;
    font-size: 18px;
    color: green;
}

.item-list table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.item-list table, .item-list th, .item-list td {
    border: 1px solid #ddd;
}

.item-list th, .item-list td {
    padding: 10px;
    text-align: left;
}

.item-list th {
    background-color: green;
    color: #fff;
}

.item-list tr:nth-child(even) {
    background-color: #f2f2f2;
}

.total {
    text-align: right;
    margin-top: 20px;
    font-size: 18px;
}

footer {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

   </style>
</head>
<body>
    <div class='receipt-container'>
        <header>
            <h1>K-Medicos</h1>
            <p>1234 Main Street, Karachi, Pakistan</p>
            <p>Phone: (021) 123-4567</p>
            <p>Email: info@k_medicos.pk</p>
        </header>
        
        <section class='receipt-body'>
            <h2>Receipt</h2>
            
            <div class='details' style='display: flex;'>
                <div class='customer-details'>
                    <h3>Customer Details</h3>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Address:</strong> $address, $country</p>
                    <p><strong>Phone:</strong> $phone</p>
                </div>
                
                <div class='transaction-details'>
                    <h3>Transaction Details</h3>
                    <p style='margin-top: 10px;'><strong>Tracking Number:</strong> #$tracking</p>
                    <p><strong>Date:</strong> $date</p>
                </div>
            </div>
            
            <div class='item-list'>
                <h3>Item Details</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$p_name</td>
                            <td>$p_quantity</td>
                            <td>PKR $p_price</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class='total'>
            <p><strong>Payment Mode:</strong> $pay_mode</p>
                <p><strong>Amount:</strong> PKR $amount</p>
                <p><strong>Tax:</strong> PKR $tax</p>
                <p><strong>Total Amount: </strong><span style='color: green;text-decoration: underline'>PKR $total</span></p>
            </div>
        </section>
        
        <footer>
            <p>Thank you for using K-Medicos!</p>
        </footer>
    </div>
</body>
</html>
";
    // Load HTML content 
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF 
    $dompdf->render();

    // Output the generated PDF to Browser 
    $dompdf->stream();
}
