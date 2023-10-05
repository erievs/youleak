# youleak
Early/Mid 2015 YouTube Revival

YouLeak Uses A Modular Design:

[PLEASE UPDATE THIS AS MORE MODULES ARE ADDED]
[ALSO NOTE HEADER WILL BE MOVE TO UNIVERSAL FOLDER SOON]

UI
 Home:
  Ads
     ad_header.php 
  Unused
     stuff.php
  Root 
     header.php
     sidebar.php
     videos_home.php
   Upload

   Watch
     footer.php
     header.php
     watch_content.php
     watch_extra.php
     watch_info.php
     watch_player.php

You Can Include Any Module By Simply Using 

<?php include 'ui/"target_section"/"target_moudle"';?>

You Can Remove Any Module By Simply Deleteing The Include

Database Connection:

Simply Include:

<?php include 'important/db.php";?>

[NOTE YOU WILL HAVE TO REPLACE $hostname, $username, $password, and $database WITH THE PROPER VALUES FOR YOUR SERVER]

Quarks:

YouLeak video conversions happen in the browser ussing ffmpeg.js, so you cannot close out of the tab
this is to make it to be able to be hosted on any service that supports PHP and MYSQL.

Libs Used:

FFMPEG.JS



  
    
