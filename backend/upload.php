<?php
// Start a new session or resume the existing session
session_start();

// Define the directory where FLV and MP4 files will be saved
$uploadDir = '../dymanic/videos/';

// Check if the "flv_video" or "mp4_video" file field is set in the request
if (isset($_FILES['flv_video']) || isset($_FILES['mp4_video'])) {
    $file = isset($_FILES['flv_video']) ? $_FILES['flv_video'] : $_FILES['mp4_video'];

    // Check if there is a video ID stored in the session
    if (isset($_SESSION['video_id'])) {
        $videoID = $_SESSION['video_id'];
        // Clear the session variable after reading it
        unset($_SESSION['video_id']);
    } else {
        // Generate a random video ID if it's not in the session
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $videoID = '';
        $length = 12;
        for ($i = 0; $i < $length; $i++) {
            $videoID .= $characters[rand(0, strlen($characters) - 1)];
        }
        // Store the generated video ID in the session
        $_SESSION['video_id'] = $videoID;
    }

    // Check if there was an error during the upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Generate a unique filename for the uploaded file using the video ID
        $randomFileName = $videoID . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $randomFileName)) {
            echo 'File uploaded successfully.';
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Error during file upload.';
    }
} else {
    echo 'No file uploaded.';
}
?>
