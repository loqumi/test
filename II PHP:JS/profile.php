<?php
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: index.html");
  exit();
}

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
$name = $_SESSION["name"];
$photo = $_SESSION["photo"];
$date_of_birth = $_SESSION["date_of_birth"];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Профиль пользователя</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<main class="section">
  <div class="container">
    <h2 class="title">Profile</h2>
    <div class="notification_container">
      <div class="success" id="success_container" style="display: none;">
        Successful authentication!
      </div>
    </div>
    <div id="error_container" style="display: none;"></div>
    <div class="user_card_grid" id="user_data_container">
      <img src="<?php echo $photo; ?>" alt="User photo">
      <div class="user_info">
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Date of birth:</strong> <?php echo $date_of_birth; ?></p>
      </div>
    </div>
    <a class="logout" href="logout.php">Logout</a>
  </div>
</main>
<script src="js/script.js"></script>
</body>
</html>
