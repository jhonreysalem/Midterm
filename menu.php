<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
}

$user_id = $_SESSION['user_id'];

$menu_result = $conn->query("SELECT * FROM MenuItems");

$cart_result = $conn->query("SELECT MenuItems.name, MenuItems.price, Cart.quantity 
                             FROM Cart 
                             JOIN MenuItems ON Cart.item_id = MenuItems.item_id 
                             WHERE Cart.user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menu</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   
  <link rel="stylesheet" href="menu.css">

  

</head>
<body>
  <div class="container mt-5">
  
    <div class="row menu-section-wrapper">
      <div class="col-md-8">
        <h2>Menu</h2>
        <div class="text-center">
          <h1>On Cloud Steak House</h1>
        </div>
        <div class="row">
          <?php while ($row = $menu_result->fetch_assoc()): ?>
            <div class="col-md-4 menu-item">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['name']; ?></h5>
                  <p class="card-text">₱<?php echo number_format($row['price'], 2); ?></p>
                  <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>

  
    <div class="col-md-4 cart-section">
      <h4>Cart</h4>
      <?php if ($cart_result->num_rows > 0): ?>
        <ul class="list-group">
          <?php 
          $total = 0; 
          while ($cart_item = $cart_result->fetch_assoc()): 
            $total += $cart_item['price'] * $cart_item['quantity'];
          ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $cart_item['name']; ?>
              <span>₱<?php echo number_format($cart_item['price'] * $cart_item['quantity'], 2); ?></span>
            </li>
          <?php endwhile; ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Total</strong>
            <span>₱<?php echo number_format($total, 2); ?></span>
          </li>
        </ul>
        <a href="checkout.php" class="btn btn-success btn-block mt-3">Proceed to Checkout</a>
      <?php else: ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
