<?php
	include "config.php";
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Get the article
		$id = $_POST['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		
		// Update the article into the database
		$query = "UPDATE articles SET title = '$title', content = '$content' WHERE id = '$ID'";
		
		mysqli_query ($conn, $query);
		
		// Redirect to the homepage after editing
		header("Location: index.php");
		exit();
	}
	
	// Get the article ID from the URL
	$id = $_GET['id'];
	
	// Fetch the article from the database
	$query = "SELECT * FROM articles WHERE id = $id";
	$result = mysqli_query($conn, $query);
	$article = mysqli_fetch_assoc($result);
?>

<form method = "POST" action = "">
	<input type = "hidden" name = "id" value = "<?php echo $article ['id']; ?>">
	<label> Title: </label><br/>
	<input type = "text" name = "title" value = "<?php echo $article ['title']; ?>"><br/><br/>
	<label> Content: </label><br/>
	<textarea name = "content"><?php echo $article['content']; ?></textarea> <br/><br/>
	<input type = "submit" value = "Update Articles";
</form>