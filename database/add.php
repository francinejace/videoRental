<?php
	include "config.php";
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Get the article
		$title = $_POST['title'];
		$content = $_POST['content'];
		
		// Insert the article into the database
		$query = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";
		
		mysqli_query ($conn, $query);
		
		// Redirect to the homepage after adding
		header("Location: index.php");
		exit();
	}
?>

<form method = "POST" action = "">
	<label> Title: </label><br/>
	<input type = "text" name = "title"><br/><br/>
	<label>Content </label><br/>
	<textarea name = "content"></textarea><br/><br/>
	<input type = "submit" value = "Add Article">
</form>