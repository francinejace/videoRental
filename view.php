
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle search
$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$videos = $search_term ? searchVideos($search_term) : getVideos();

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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Videos (<?php echo count($videos); ?> found)</h3>
        <div class="card-tools">
            <form method="GET" action="index.php" class="form-inline">
                <input type="hidden" name="page" value="view">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search videos..." value="<?php echo htmlspecialchars($search_term); ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <?php if ($search_term): ?>
            <p class="text-muted">Search results for: "<strong><?php echo htmlspecialchars($search_term); ?></strong>" 
            <a href="index.php?page=view" class="btn btn-sm btn-secondary">Clear Search</a></p>
        <?php endif; ?>
        
        <div class="mb-3">
            <a href="index.php?page=add" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Video
            </a>
        </div>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Director</th>
                    <th>Genre</th>
                    <th>Release Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($videos) > 0) {
                    foreach ($videos as $video) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($video['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($video['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($video['director']) . "</td>";
                        echo "<td>" . htmlspecialchars($video['genre'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($video['release_year']) . "</td>";
                        echo "<td>
                            <a href='index.php?page=view_single&id={$video['id']}' class='btn btn-sm btn-primary' title='View Details'>
                                <i class='fas fa-eye'></i>
                            </a>
                            <a href='index.php?page=edit&id={$video['id']}' class='btn btn-sm btn-info' title='Edit'>
                                <i class='fas fa-edit'></i>
                            </a>
                            <a href='index.php?page=delete&id={$video['id']}' class='btn btn-sm btn-danger' title='Delete' onclick='return confirm(\"Are you sure you want to delete this video?\")'>
                                <i class='fas fa-trash'></i>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    $message = $search_term ? "No videos found matching your search." : "No videos found. Start by adding a new video!";
                    echo "<tr><td colspan='6' class='text-center text-muted'>" . $message . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>