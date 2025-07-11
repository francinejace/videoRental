<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['alert'])) {
    $_SESSION['alert'] = null;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['videos'])) {
    $_SESSION['videos'] = array(); // Initialize videos session array if not already set
}

require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Rental System</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php include 'menu.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <?php
                $page = $_GET['page'] ?? 'home'; // Default to home page if no specific page request
                switch ($page) {
                    case 'add':
                        include 'add.php';
                        break;
                    case 'edit':
                        include 'edit.php';
                        break;
                    case 'delete':
                        include 'delete.php';
                        break;
                    case 'view':
                        include 'view.php';
                        break;
                    case 'view_single':
                        include 'view_single.php';
                        break;
                    default:
                        // Home page content
                        $total_videos = getTotalVideos();
                        $recent_videos = array_slice(getVideos(), 0, 5); // Get 5 most recent videos
                        
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
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php echo $total_videos; ?></h3>
                                        <p>Total Videos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-video"></i>
                                    </div>
                                    <a href="index.php?page=view" class="small-box-footer">
                                        View All <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Welcome to Video Rental System</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>Manage your video collection with ease. You can:</p>
                                        <ul>
                                            <li>Add new videos to your collection</li>
                                            <li>View and search through all videos</li>
                                            <li>Edit video information</li>
                                            <li>Delete videos from your collection</li>
                                        </ul>
                                        <div class="mt-3">
                                            <a href="index.php?page=add" class="btn btn-success">
                                                <i class="fas fa-plus"></i> Add New Video
                                            </a>
                                            <a href="index.php?page=view" class="btn btn-primary">
                                                <i class="fas fa-list"></i> View All Videos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Recent Videos</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if (count($recent_videos) > 0): ?>
                                            <ul class="list-unstyled">
                                                <?php foreach ($recent_videos as $video): ?>
                                                    <li class="mb-2">
                                                        <a href="index.php?page=view_single&id=<?php echo $video['id']; ?>" class="text-decoration-none">
                                                            <strong><?php echo htmlspecialchars($video['title']); ?></strong>
                                                        </a>
                                                        <br>
                                                        <small class="text-muted">
                                                            <?php echo htmlspecialchars($video['director']); ?> • 
                                                            <?php echo htmlspecialchars($video['release_year']); ?>
                                                        </small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <a href="index.php?page=view" class="btn btn-sm btn-outline-primary">View All</a>
                                        <?php else: ?>
                                            <p class="text-muted">No videos in your collection yet.</p>
                                            <a href="index.php?page=add" class="btn btn-success">Add Your First Video</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                }
                ?>
            </div>
        </section>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2023 Your Company.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>
<!-- REQUIRED SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>