<?php

//phpinfo();

ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");

//echo "som";

/* require the user as the parameter */
//if(isset($_GET['email']) && intval($_GET['email'])) {

    //echo "in get";

    /* soak in the passed variable or set our own */
    //$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
    //$format = strtolower($_GET['format']) == 'json' ? 'xml' : 'json'; //xml is the default
    //$user_id = intval($_GET['email']); / .  default

    $user_id = "gbahl@gmu.edu";

   // echo "userid=" . $user_id;

    /* connect to the db */
    $link = new mysqli('localhost','root','brazzer','krasnow_db') or die('Cannot connect to the DB');
    //mysql_select_db('krasnow_db',$link) or die('Cannot select the DB');



  //  echo "my sql is connected</br>";

    /* grab the posts from the db */
    /*$query = "SELECT post_title, guid FROM wp_posts WHERE post_author = $user_id AND post_status = 'publish' ORDER BY ID DESC LIMIT $number_of_posts";*/

    $query =  "SELECT id as orderId, order_date as dateOfOrder, product_name as productName FROM orders where email= '$user_id'";
    $result = $link->query($query) or die('Errant query:  '.$query);

   // echo "my sql results fetched</br>";

    /* create one master array of the records */
    $orders = array();
    if($result->num_rows>0) {
        while($order = $result->fetch_assoc()) {
            $orders[] = $order;
        }
    }

    /* output in necessary format */
    //if($format == 'json') {
        header('Content-type: application/json');
        echo json_encode(array('orders'=>$orders));
    //}
    /*else {
        header('Content-type: text/xml');
        echo '<posts>';
        foreach($posts as $index => $post) {
            if(is_array($post)) {
                foreach($post as $key => $value) {
                    echo '<',$key,'>';
                    if(is_array($value)) {
                        foreach($value as $tag => $val) {
                            echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
                        }
                    }
                    echo '</',$key,'>';
                }
            }
        }
        echo '</posts>';*/
    //}

    /* disconnect from the db */
   $link->close();
//}

?>