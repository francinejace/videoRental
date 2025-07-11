<?php
require_once 'database/config.php';

// Add a video to the database
function addVideoToDB($title, $director, $genre, $release_year) {
    global $conn;
    
    $title = mysqli_real_escape_string($conn, $title);
    $director = mysqli_real_escape_string($conn, $director);
    $genre = mysqli_real_escape_string($conn, $genre);
    $release_year = (int)$release_year;
    
    $query = "INSERT INTO videos (title, director, genre, release_year) VALUES ('$title', '$director', '$genre', $release_year)";
    
    if (mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn);
    }
    return false;
}

// Get all videos from the database
function getVideosFromDB() {
    global $conn;
    
    $query = "SELECT * FROM videos ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    
    $videos = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $videos[] = $row;
        }
    }
    
    return $videos;
}

// Get a single video by ID from the database
function getVideoByIdFromDB($id) {
    global $conn;
    
    $id = (int)$id;
    $query = "SELECT * FROM videos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

// Update a video in the database
function editVideoInDB($id, $title, $director, $genre, $release_year) {
    global $conn;
    
    $id = (int)$id;
    $title = mysqli_real_escape_string($conn, $title);
    $director = mysqli_real_escape_string($conn, $director);
    $genre = mysqli_real_escape_string($conn, $genre);
    $release_year = (int)$release_year;
    
    $query = "UPDATE videos SET title = '$title', director = '$director', genre = '$genre', release_year = $release_year WHERE id = $id";
    
    return mysqli_query($conn, $query);
}

// Delete a video from the database
function deleteVideoFromDB($id) {
    global $conn;
    
    $id = (int)$id;
    $query = "DELETE FROM videos WHERE id = $id";
    
    return mysqli_query($conn, $query);
}

// Search videos in the database
function searchVideosInDB($search_term) {
    global $conn;
    
    $search_term = mysqli_real_escape_string($conn, $search_term);
    $query = "SELECT * FROM videos WHERE title LIKE '%$search_term%' OR director LIKE '%$search_term%' OR genre LIKE '%$search_term%' ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    
    $videos = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $videos[] = $row;
        }
    }
    
    return $videos;
}

// Get total count of videos
function getVideoCount() {
    global $conn;
    
    $query = "SELECT COUNT(*) as total FROM videos";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    
    return 0;
}
?>

