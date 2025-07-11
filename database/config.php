<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "cms";
	
	$conn = mysqli_connect ($host, $username, $password, $database);
	
	if (!$conn) {
		die ("Connection failed: " .mysqli_connect_error());
	}
	
	// Create videos table if it doesn't exist
	$create_table_query = "CREATE TABLE IF NOT EXISTS videos (
		id INT AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(255) NOT NULL,
		director VARCHAR(255),
		genre VARCHAR(255),
		release_year INT,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";
	
	mysqli_query($conn, $create_table_query);
?>

