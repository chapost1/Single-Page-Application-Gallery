<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spa_img_categories";

$conn = new mysqli($servername, $username, $password, $dbname);

$GLOBALS['conn'] = $conn;