<?php
// Start the session
//The session_start() function must be the very first thing in your document. Before any HTML tags.
session_start();
session_destroy();
?>
<html>
<head>
 <?php require_once "includes/metatags.php"?>
</head>
<body>
You are sucessfully logged out !! <a href="login.php">Click here to log in </a>
</body>
</html>