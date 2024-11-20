<?php
session_start();
include('db_connection.php');

// Check if form is submitted (using POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash the password before storing it in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare and execute the insert statement
  $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
  $stmt->bind_param('ss', $username, $hashedPassword);
  
  if ($stmt->execute()) {
    // Registration successful, redirect to login page
    $_SESSION['registration_success'] = true;
    header('Location: login.php');
  } else {
    // Registration failed, display error message
    echo "Failed to register user.";
  }
  
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Register</h2>
    
    <?php
      // Check if registration was successful (from session)
      if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
        echo "<p class='alert alert-success'>Registration successful! Please login.</p>";
        // Unset the session variable to avoid displaying message after refresh
        unset($_SESSION['registration_success']);
      }
    ?>
    
    <form method="POST" action="register.php">
      <input type="text" name="username" placeholder="Username" required class="form-control">
      <input type="password" name="password" placeholder="Password" required class="form-control mt-2">
      <button type="submit" class="btn btn-primary mt-2">Register</button>
    </form>
  </div>
</body>
</html>