<?php 
 
// Database configuration    
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', 'musab'); 
define('DB_NAME', 'organizehub'); 
 
// Google API configuration 
define('GOOGLE_CLIENT_ID', '132064980799-45msf2nv4f7p49gf9m6e7rugb84me5cc.apps.googleusercontent.com'); 
define('GOOGLE_CLIENT_SECRET', 'aMo5xNQDAB5IL6dK9yQCPEUI5Hk'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar'); 
define('REDIRECT_URI', 'https://www.example.com/google_calendar_event_sync.php'); 
 
// Start session 
if(!session_id()) session_start(); 
 
// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online'; 
 
?>