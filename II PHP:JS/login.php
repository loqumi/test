<?php
$host = "localhost";
$username = "ваше_имя_пользователя";
$password = "ваш_пароль";
$dbname = "имя_вашей_базы_данных";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  session_start();
  $_SESSION["user_id"] = $user["id"];
  $_SESSION["username"] = $user["username"];
  $_SESSION["name"] = $user["name"];
  $_SESSION["photo"] = $user["photo"];
  $_SESSION["date_of_birth"] = $user["date_of_birth"];

  $cookie_name = "user_auth";
  $cookie_value = $user["id"];
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => "Incorrect login or password"]);
}

$stmt->close();
$conn->close();
?>
