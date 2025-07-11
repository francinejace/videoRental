<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Call the addVideo function from functions.php
    $result = addVideo($_POST['title'], $_POST['director'], $_POST['release_year'], $_POST['genre']);
    
    if ($result) {
        setAlert('Video added successfully!', 'success');
        // Redirect to view page to see the new video
        header('Location: index.php?page=view');
        exit();
    } else {
        setAlert('Error adding video. Please try again.', 'danger');
    }
}

// Display alert if exists
$alert = getAlert();
if ($alert) {
    echo '<div class="alert alert-' . $alert['type'] . ' alert-dismissible fade show" role="alert">
            ' . htmlspecialchars($alert['message']) . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Video</h3>
    </div>
    <form action="index.php?page=add" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" class="form-control" name="director" placeholder="Enter director" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" name="genre" placeholder="Enter genre (e.g., Action, Comedy, Drama)">
            </div>
            <div class="form-group">
                <label for="release_year">Release Year</label>
                <input type="number" class="form-control" name="release_year" placeholder="Enter release year" min="1900" max="2030" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Video</button>
            <a href="index.php?page=view" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>