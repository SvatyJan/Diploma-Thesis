<!DOCTYPE html>
<html>
<head>
    <title>BP Vývoj herní databáze</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/combat.js"></script>
    <link rel="icon" type="image/x-icon" href="icons/default.png">
</head>
<body class="body">
<?php
require("connect.php");
require("functions.php");
@session_start();

$id = $_SESSION['id'] ?? false;
$username = $_SESSION['login'] ?? false;

$pages = $_GET["pages"] ?? "main";
$splitpage = (explode('?', $pages));
$pagename = $splitpage[0];

if($pagename != "combat"){
    include_once("templates/header.php");
}
//echo "<h2 class='nadpis-stranky'>".ucfirst($pages)."</h2>";
?>
<div class="menu-content-wrap">
<?php
if (file_exists("templates/" . $splitpage[0] . ".php"))
    include_once("templates/" . $splitpage[0] . ".php");
else
    include_once("templates/404.php");
?>
</div>
<?php
if($pagename != "combat"){
    include_once("templates/footer.php");
}


?>
</body>
</html>
