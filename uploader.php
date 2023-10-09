<?php

session_start();
unset($_SESSION['video_id']);
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouLeak Uploader</title>

    <script src="assets/js/upload/ffmpeg.min.js"></script>
    <script src="assets/js/upload/processMP4.js"></script>
    <script src="assets/js/upload/processFLV.js"></script>
</head>
<body>
    <h1>YouLeak Uploader</h1>
    <input type="file" id="file-input" accept="video/*">
    <button id="process-button">Upload</button>
    <a id="download-link-flv" style="display: none;"></a>
    <a id="download-link-mp4" style="display: none;"></a>
</body>
</html>