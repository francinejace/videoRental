<?php
	include "config.php";
	
	// Get the article ID from the URL
	$id = $_GET ['id'];
	
	// Delete the chosen article from the database
	$query = "DELETE FROM articles WHERE id = $id";
	mysqli_query($conn, $query);
	
	// Redirect to the homepage after deleting
	header("Location: index.php");
	exit();
?>