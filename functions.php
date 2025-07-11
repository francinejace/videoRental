<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database functions
require_once 'database_functions.php';

// Add a video (now uses database)
function addVideo($title, $director, $release_year, $genre = '') {
    return addVideoToDB($title, $director, $genre, $release_year);
}

// Get all videos (now uses database)
function getVideos() {
    return getVideosFromDB();
}

// Get a single video by ID (now uses database)
function getVideoById($id) {
    return getVideoByIdFromDB($id);
}

// Update a video (now uses database)
function editVideo($id, $title, $director, $release_year, $genre = '') {
    return editVideoInDB($id, $title, $director, $genre, $release_year);
}

// Delete a video (now uses database)
function deleteVideo($id) {
    return deleteVideoFromDB($id);
}

// Search videos
function searchVideos($search_term) {
    return searchVideosInDB($search_term);
}

// Get video count
function getTotalVideos() {
    return getVideoCount();
}

// Set alert message
function setAlert($message, $type = 'success') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

// Get and clear alert message
function getAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
        return $alert;
    }
    return null;
}
?>