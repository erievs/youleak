<?php
// Define the directory where processed videos are stored
$uploadDirectory = '../dymanic/videos';

// Function to fetch a video by its ID
function fetchVideoById($videoId, $uploadDirectory) {
    $videoPath = $uploadDirectory . '/' . $videoId . '.flv'; 
    
    // Check if the video file exists
    if (file_exists($videoPath)) {
        // Set the appropriate headers for video streaming
        header('Content-Type: video/x-flv');
        header('Content-Length: ' . filesize($videoPath));
        
        // Set the Content-Disposition header to specify the original file name
        header('Content-Disposition: inline; filename="' . $videoId . '.flv"');

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
    $videoId = $_GET['video_id'];
    fetchVideoById($videoId, $uploadDirectory);
} else {
    // Video ID is not provided
    http_response_code(400);
    echo 'Video ID is missing.';
}
?>
