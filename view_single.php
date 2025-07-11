<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id'])) {
    $video = getVideoById($_GET['id']);
    if ($video !== null) {
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Video Details</h3>
        <div class="card-tools">
            <span class="badge badge-primary">ID: <?php echo htmlspecialchars($video['id']); ?></span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4><?php echo htmlspecialchars($video['title']); ?></h4>
                <p class="text-muted mb-3">
                    <?php echo htmlspecialchars($video['genre'] ?? 'Genre not specified'); ?> • 
                    <?php echo htmlspecialchars($video['release_year']); ?>
                </p>
                
                <dl class="row">
                    <dt class="col-sm-3">Director:</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($video['director']); ?></dd>
                    
                    <dt class="col-sm-3">Genre:</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($video['genre'] ?? 'Not specified'); ?></dd>
                    
                    <dt class="col-sm-3">Release Year:</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($video['release_year']); ?></dd>
                    
                    <?php if (isset($video['created_at'])): ?>
                    <dt class="col-sm-3">Added:</dt>
                    <dd class="col-sm-9"><?php echo date('F j, Y \a\t g:i A', strtotime($video['created_at'])); ?></dd>
                    <?php endif; ?>
                    
                    <?php if (isset($video['updated_at']) && $video['updated_at'] != $video['created_at']): ?>
                    <dt class="col-sm-3">Last Updated:</dt>
                    <dd class="col-sm-9"><?php echo date('F j, Y \a\t g:i A', strtotime($video['updated_at'])); ?></dd>
                    <?php endif; ?>
                </dl>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="index.php?page=view" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
        <a href="index.php?page=edit&id=<?php echo $video['id']; ?>" class="btn btn-info">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="index.php?page=delete&id=<?php echo $video['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">
            <i class="fas fa-trash"></i> Delete
        </a>
    </div>
</div>
<?php
    } else {
        echo '<div class="alert alert-warning">
                <h4>Video Not Found</h4>
                <p>The requested video could not be found.</p>
                <a href="index.php?page=view" class="btn btn-primary">Back to Videos</a>
              </div>';
    }
} else {
    echo '<div class="alert alert-danger">
            <h4>No Video ID Specified</h4>
            <p>Please select a video to view its details.</p>
            <a href="index.php?page=view" class="btn btn-primary">Back to Videos</a>
          </div>';
}
?>