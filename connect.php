<?php

				$servername = "localhost";
				$username = "admin";
				$password = "admin12345678";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>