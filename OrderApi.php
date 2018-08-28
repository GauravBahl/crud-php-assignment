<?php

//phpinfo();

ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
    $user_id = "";

    $link = new mysqli('localhost','root','brazzer','krasnow_db') or die('Cannot connect to the DB');
    
    $query =  "SELECT id as orderId, order_date as dateOfOrder, product_name as productName FROM orders where email= '$user_id'";
    $result = $link->query($query) or die('Errant query:  '.$query);

    $orders = array();
    if($result->num_rows>0) {
        while($order = $result->fetch_assoc()) {
            $orders[] = $order;
        }
    }

        header('Content-type: application/json');
        echo json_encode(array('orders'=>$orders));
  
   $link->close();

?>