<?php
$db = mysqli_connect('localhost', 'root', '', 'medicine_website');
$pending_time=mysqli_query($db,"SELECT * FROM `orders` join `tracking` on `orders`.`tracking_no` = `tracking`.`tracking_no` WHERE `status` = 'pending'");
foreach ($pending_time as $row) {
  $time = $row['date'];
  $tracking=$row['tracking_no'];
  // add one day to the current date when time reached delete order
  $date = strtotime("+1 day", strtotime($time));
  $date = date('Y-m-d H:i s', $date);
  if ($date <= date('Y-m-d H:i s')) {
    mysqli_query($db, "DELETE FROM `orders` WHERE `tracking_no` = '$tracking'");
    mysqli_query($db, "DELETE FROM `tracking` WHERE `tracking_no` = '$tracking'");
  }
  
}
