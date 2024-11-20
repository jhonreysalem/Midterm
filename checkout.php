<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT MenuItems.name, MenuItems.price, Cart.quantity 
                        FROM Cart JOIN MenuItems ON Cart.item_id = MenuItems.item_id 
                        WHERE Cart.user_id = $user_id");

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>

body {
    background-color: #f5f5f5; 
    color: #333333; 
    font-family: 'Arial', sans-serif;
}

.navbar {
    background-color: #2ecc71; 
    color: #fff;
}

.navbar-brand, .navbar-nav .nav-link {
    color: inherit !important;
}

.container {
    margin-top: 60px;
}

h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #27ae60; 
}

h4 {
    font-size: 1.5rem;
    color: #2ecc71; 
}

table {
    background-color: #ffffff; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    margin-bottom: 30px; 
}

th, td {
    padding: 15px;
    text-align: center;
    font-size: 1rem;
}

th {
    background-color: #27ae60; 
    color: #fff; 
}

td {
    background-color: #f9f9f9; 
}

tr:nth-child(even) td {
    background-color: #ecf0f1;
}


.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 1.1rem;
    color: #27ae60; 
    font-weight: 600;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ddd; 
    padding: 10px;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #2ecc71; 
    box-shadow: 0 0 5px rgba(46, 204, 113, 0.5); 
}


.btn-custom {
    background-color: #27ae60; 
    color: white;
    border: none;
    font-size: 1.2rem;
    padding: 12px 20px;
    border-radius: 5px;
    width: 100%;
}

.btn-custom:hover {
    background-color: #2ecc71; 
}


@media (max-width: 768px) {
    .container {
        margin-top: 40px;
    }

    h2 {
        font-size: 2rem;
    }

    h4 {
        font-size: 1.2rem;
    }

    th, td {
        font-size: 0.9rem;
        padding: 10px;
    }
}
</style>

</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>₱<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php $total_price += $row['price'] * $row['quantity']; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h4>Total: ₱<?php echo number_format($total_price, 2); ?></h4>
        <form action="process_payment.php" method="POST">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" class="form-control">
                    <option value="CreditCard">Credit Card</option>
                    <option value="CashOnDelivery">Cash on Delivery</option>
                    <option value="GCash">GCash</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_option">Delivery Option:</label>
                <select name="delivery_option" class="form-control">
                    <option value="Food Panda">Food Panda</option>
                    <option value="Epcst Delivery">Grab Food</option>
                </select>
            </div>
            <button type="submit" class="btn-custom">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
