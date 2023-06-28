<?php
$pages = "default";
$pages = $_GET["profilepage"] ?? "profile";
$splitpage = (explode('?', $pages));
$profileid = $_GET["id"];
?>
<div class="profile-menu">
    <a class="profile-menu-link" href='index.php?pages=profile&id=<?= $profileid; ?>&profilepage=profile'>Character</a>
    <a class="profile-menu-link" href='index.php?pages=profile&id=<?= $profileid; ?>&profilepage=inventory'>Inventory</a>
    <a class="profile-menu-link" href='index.php?pages=profile&id=<?= $profileid; ?>&profilepage=spellbook'>Spellbook</a>
    <?php
    if($_SESSION["id"] === $_GET["id"]){
        ?> <a class="profile-menu-link" href='index.php?pages=profile&id=<?= $_SESSION["id"]; ?>&profilepage=interact'>Icons</a> <?php
    } else {
        ?> <a class="profile-menu-link" href='index.php?pages=profile&id=<?= $profileid; ?>&profilepage=interact'>Interact</a><?php
    }
    ?>

</div>
<?php

if($splitpage[0] == "profile"){
include_once("character.php");
}
else{
    if (file_exists("templates/" . $splitpage[0] . ".php"))
        include_once("templates/" . $splitpage[0] . ".php");
    else
        include_once("templates/404.php");
}
?>
