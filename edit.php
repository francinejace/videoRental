<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $result = editVideo($_GET['id'], $_POST['title'], $_POST['director'], $_POST['release_year'], $_POST['genre']);
    
    if ($result) {
        setAlert('Video updated successfully!', 'success');
        header('Location: index.php?page=view');
        exit();
    } else {
        setAlert('Error updating video. Please try again.', 'danger');
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

if (isset($_GET['id'])) {
    $video = getVideoById($_GET['id']);
    if ($video !== null) {
?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Video</h3>
    </div>
    <form action="index.php?page=edit&id=<?php echo $video['id']; ?>" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($video['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Director</label>
                <input type="text" class="form-control" name="director" value="<?php echo htmlspecialchars($video['director']); ?>" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($video['genre'] ?? ''); ?>" placeholder="Enter genre (e.g., Action, Comedy, Drama)">
            </div>
            <div class="form-group">
                <label>Release Year</label>
                <input type="number" class="form-control" name="release_year" value="<?php echo htmlspecialchars($video['release_year']); ?>" min="1900" max="2030" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-info">Update Video</button>
            <a href="index.php?page=view" class="btn btn-secondary">Cancel</a>
            <a href="index.php?page=view_single&id=<?php echo $video['id']; ?>" class="btn btn-primary">View Details</a>
        </div>
    </form>
</div>
<?php
    } else {
        echo '<div class="alert alert-warning">Video not found.</div>';
        echo '<a href="index.php?page=view" class="btn btn-primary">Back to Videos</a>';
    }
} else {
    echo '<div class="alert alert-danger">No video ID specified.</div>';
    echo '<a href="index.php?page=view" class="btn btn-primary">Back to Videos</a>';
}
?>