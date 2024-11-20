<?php
session_start();
include('db_connection.php');

if (isset($_POST['item_id'])) {
  $user_id=$_SESSION['user_id'];
  $item_id=$_POST['item_id'];

  $sql ="INSERT INTO Cart(user_id, item_id, quantity) VALUES ($user_id, $item_id, 1)"; 

  if($conn->query($sql)===TRUE) {
  
    header('Location:menu.php'); 
  } else {
    echo "Error:".$sql."<br>".$conn->error;
  }
} else {
 
  echo "Error adding to cart.";
}
?>