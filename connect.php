<?php

				$servername = "localhost";
				$username = "admin";
				$password = "";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
