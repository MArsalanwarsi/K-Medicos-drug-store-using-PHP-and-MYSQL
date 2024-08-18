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
    <meta charset='utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='images/logo.png' rel='icon' />
    <title>Order Invoice K-Medicos</title>

    <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
    <style>
    .table {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .table-row {
        display: table-row;
    }

    .table-cell {
        display: table-cell;
        border: 1px solid black;
        padding: 1em;
    }
        .noborder{
        border:none;
}
</style>
</head>

<body>
    <div class='max-w-7xl mx-auto'>
        <header class='flex justify-between px-10 py-5'>
            <h2 class='text-2xl font-bold' style='margin-top: 20px;'>K-Medicos</h2>
            <h1 class='text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl flex items-end'>
                Invoice</h1>
        </header>

        <hr>

        <section class='flex justify-between px-10 py-5'>
            <p class='text-xs'>
                <strong>Date:</strong>
                <span>$date</span>
            </p>

            <p class='text-xs'>
                <strong>Invoice No:</strong>
                18635
            </p>
        </section>

        <hr>

        <section class='flex justify-between px-10 py-5'>
            <p class='text-xs'>
                <strong>Invoiced To:</strong><br>
                <span class='name'>$name</span><br>
                <span class='address'>$address</span><br>
                <span class='country'>$country</span><br>
                 <span class='phone_no'>$phone</span><br>
            </p>

            <p class='text-xs text-right'>
                <strong>Pay Mode:</strong><br>
                <span class='pay_mode'>$pay_mode</span>
            </p>
        </section>

        <section class='px-10 py-5'>
            <div class='shadow overflow-hidden border-b border-gray-200 sm:rounded-lg'>
               <div class='table'>
    <div class='table-row'>
        <div class='table-cell'><b>Product Name</b></div>
        <div class='table-cell'><b>Quantity</b></div>
        <div class='table-cell'><b> Unit Price</b></div>
        <div class='table-cell'><b>Amount</b></div>

    </div>
    <div class='table-row'>
        <div class='table-cell'>$p_name</div>
        <div class='table-cell'> $p_quantity</div>
        <div class='table-cell'>$p_price</div>
        <div class='table-cell'>$amount</div>
    </div>
     <div class='table-row'>
      <div class='table-cell noborder'></div>
        <div class='table-cell noborder'></div>
         <div class='table-cell noborder'></div>
        <div class='table-cell noborder'></div>
     </div>
    <div class='table-row'>
        <div class='table-cell noborder'></div>
        <div class='table-cell noborder'></div>
        <div class='table-cell'> Sub-Total</div>
        <div class='table-cell'>$amount</div>
    </div>
    <div class='table-row'>
        <div class='table-cell noborder'></div>
        <div class='table-cell noborder'></div>
        <div class='table-cell'> GST @ 18%</div>
        <div class='table-cell'>$tax</div>
    </div>
    <div class='table-row'>
        <div class='table-cell noborder'></div>
        <div class='table-cell noborder'></div>
        <div class='table-cell'>Total</div>
        <div class='table-cell'>$total</div>
    </div>
</div>
            </div>
        </section>
    </div>
</body>

</html>";
    // Load HTML content 
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF 
    $dompdf->render();

    // Output the generated PDF to Browser 
    $dompdf->stream();





}

?>