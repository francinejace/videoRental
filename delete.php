<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if a valid video ID is passed and deletion has not yet been confirmed
if (isset($_GET['id']) && !isset($_GET['confirm'])) {
    $videoId = (int)$_GET['id'];
    $video = getVideoById($videoId); // Retrieve video details

    if ($video) {
?>
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Delete Video</h3>
            </div>
            <div class="card-body">
                <p class="text-danger"><strong>Warning:</strong> Are you sure you want to delete this video? This action cannot be undone.</p>
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Title:</strong> <?= htmlspecialchars($video['title']) ?></h5>
                        <p class="card-text"><strong>Director:</strong> <?= htmlspecialchars($video['director']) ?></p>
                        <p class="card-text"><strong>Genre:</strong> <?= htmlspecialchars($video['genre'] ?? 'N/A') ?></p>
                        <p class="card-text"><strong>Release Year:</strong> <?= htmlspecialchars($video['release_year']) ?></p>
                        <?php if (isset($video['created_at'])): ?>
                        <p class="card-text"><small class="text-muted">Added: <?= date('M d, Y', strtotime($video['created_at'])) ?></small></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="index.php?page=delete&confirm=yes&id=<?= $videoId; ?>" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Yes, Delete Video
                </a>
                <a href="index.php?page=view" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <a href="index.php?page=view_single&id=<?= $videoId; ?>" class="btn btn-info">
                    <i class="fas fa-eye"></i> View Details
                </a>
            </div>
        </div>
<?php
    } else {
        setAlert("Video not found.", "danger");
        header('Location: index.php?page=view');
        exit();
    }
} elseif (isset($_GET['confirm']) && $_GET['confirm'] == 'yes' && isset($_GET['id'])) {
    // Confirm deletion
    $videoId = (int)$_GET['id'];
    if (deleteVideo($videoId)) {
        setAlert('Video deleted successfully!', 'success');
    } else {
        setAlert('Failed to delete video. Video not found.', 'danger');
    }
    header('Location: index.php?page=view'); // Redirect to the video list page
    exit();
} else {
    // No ID was provided
    setAlert('No video ID specified.', 'danger');
    header('Location: index.php?page=view');
    exit();
}
?>

