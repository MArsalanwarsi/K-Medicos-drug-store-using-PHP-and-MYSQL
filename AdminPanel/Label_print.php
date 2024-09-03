<?php
// Include autoloader 
require_once '../vendor/autoload.php';
include 'phpqrcode/qrlib.php';
// Reference the Dompdf namespace 
use Dompdf\Dompdf;

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
if (isset($_POST["print_label"])) {
    include "../config.php";
    $order_id = $_POST["order"];
    $query = mysqli_query($db, "SELECT * FROM orders WHERE id = '$order_id'");
    $data = mysqli_fetch_assoc($query);
    $date = date("Y/m/d");
    $name = $data['u_name'];
    $address = $data['u_address'];
    $phone = $data['u_phone'];
    $country = $data['u_country'];
    $pay_mode = $data['delivery_status'];
    $p_name = $data['p_name'];
    $p_quantity = $data['p_quantity'];
    $p_price = $data['p_price'];
    $amount = $p_price * $p_quantity;
    $tax = $amount * 0.18;
    $total = $amount + $tax;
    $qr_data = "$name \ $address \ $country \ $phone  \ $pay_mode \  Product: $p_name \  Quantiy: $p_quantity \  Total: PKR $total";

    // create temp qr code img ---start

    $tempDir = "images/";
    $codeContents = $qr_data;
    $fileName = '005_file_' . md5($codeContents) . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $urlRelativeFilePath = "images/" . $fileName;
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    }

    // create temp qr code img ---end


    // convert image to base64 ----start

    function ImageToDataUrl(String $filename): String
    {
        if (!file_exists($filename))
            throw new Exception('File not found.');

        $mime = mime_content_type($filename);
        if ($mime === false)
            throw new Exception('Illegal MIME type.');

        $raw_data = file_get_contents($filename);
        if (empty($raw_data))
            throw new Exception('File not readable or empty.');

        return "data:{$mime};base64," . base64_encode($raw_data);
    }

    // convert image to base64 ----end

    // qr code image created and saved in varaible

    $qr_img = ImageToDataUrl($urlRelativeFilePath);


    // create html for pdf
    $html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>K-Medicos Shipping Label</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fffff;
    color: #333;
    margin: 0;
    padding: 0;
}

.label-container {
    width: 100%;
    max-width: 700px;
    margin: 30px auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header {
    text-align: center;
    margin-bottom: 20px;
    background-color: green;
    color: #ffffff;
    padding: 15px;
    border-radius: 8px;
}

header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
}

header p {
    margin: 5px 0;
    font-size: 14px;
}

.shipping-info, .package-info {
    margin-bottom: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    background-color: #ffffff;
}

.shipping-info h2, .package-info h2, .qr-code h2 {
    font-size: 20px;
    color: green;
    margin-top: 0;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 8px;
}

.shipping-info p, .package-info p {
    margin: 5px 0;
    font-size: 14px;
}

.package-info table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.package-info table, .package-info th, .package-info td {
    border: 1px solid #e0e0e0;
}

.package-info th, .package-info td {
    padding: 10px;
    text-align: left;
    font-size: 13px;
}

.package-info th {
    background-color: green;
    color: #ffffff;
}

.package-info tr:nth-child(even) {
    background-color: #f9f9f9;
}

.qr-code {
    text-align: center;
    margin-bottom: 10px;
}

.qr-code h2 {
    font-size: 20px;
    color: green;
    margin-top: 0;
}

.qr-code img {
    width: 140px;
    height: 140px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: #ffffff;
}

footer {
    text-align: center;
    font-size: 14px;
    color: #666;
    margin-top: 10px;
    border-top: 1px solid #e0e0e0;
    padding-top: 10px;
}

    </style>
</head>
<body>
    <div class='label-container'>
        <header>
            <h1>K-Medicos</h1>
            <p>1234 Main Street, Karachi, Pakistan</p>
            <p>Phone: (021) 123-4567</p>
            <p>Email: info@k_medicos.pk</p>
        </header>
        
        <section class='shipping-info'>
            <div class='section'>
                <h2>Sender Information</h2>
                <p><strong>Name:</strong> K-Medicos</p>
                <p><strong>Address:</strong> 1234 Main Street, Karachi, Pakistan</p>
                <p><strong>Phone:</strong> (021) 123-4567</p>
                <p><strong>Email:</strong> info@k_medicos.pk</p>
            </div>
            </section>
             <section class='shipping-info'>
            <div class='section'>
                <h2>Recipient Information</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Address:</strong> $address, $country</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Mode:</strong> $pay_mode</p>
            </div>
        </section>
        
        <section class='package-info'>
            <h2>Package Details</h2>
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
                            <td>PKR $total</td>
                        </tr>
                    </tbody>
            </table>
        </section>
        
        <section class='qr-code'>
            <h2>Tracking QR Code</h2>
            <img src='$qr_img' alt='QR Code' id='qr-code'>
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
    // delete temp qr code image
    unlink($urlRelativeFilePath);
}
