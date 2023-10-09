<?php
// Define the directory where processed videos are stored
$uploadDirectory = '../dymanic/videos';

// Function to fetch a video by its ID
function fetchVideoById($videoId, $uploadDirectory) {
    $videoPath = $uploadDirectory . '/' . $videoId . '.mp4'; 
    
    // Check if the video file exists
    if (file_exists($videoPath)) {
        // Set the appropriate headers for video streaming
        header('Content-Type: video/mp4');
        header('Content-Length: ' . filesize($videoPath));

        // Output the video file
        readfile($videoPath);
        exit;
    } else {
        // Video not found
        http_response_code(404);
        echo 'Video not found.';
    }
}

// Check if a video ID is provided in the request
if (isset($_GET['video_id'])) {
    // Get the video ID from the request
    $videoId = strtok($_GET['video_id'], '&');

    fetchVideoById($videoId, $uploadDirectory);
} else {
    // Video ID is not provided
    http_response_code(400);
    echo 'Video ID is missing.';
}
?>
