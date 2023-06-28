<?php
$pages = "default";
$pages = $_GET["adminpage"] ?? "admingeneral";
$splitpageadmin = (explode('?', $pages));

if($_SESSION["rank"] != 2){header("Location: index.php");}
?>
<div class="profile-menu">
    <a class="profile-menu-link" href='index.php?pages=admin&adminpage=admingeneral'>General</a>
    <a class="profile-menu-link" href='index.php?pages=admin&adminpage=admincharacters'>Characters</a>
    <a class="profile-menu-link" href='index.php?pages=admin&adminpage=adminitems'>Items</a>
    <a class="profile-menu-link" href='index.php?pages=admin&adminpage=adminspells'>Spells</a>
    <a class="profile-menu-link" href='index.php?pages=admin&adminpage=adminmonsters'>Monsters</a>
</div>
<?php

if($splitpageadmin[0] == "admin"){
    include_once("admin.php");
}
else{
    if (file_exists("templates/" . $splitpageadmin[0] . ".php"))
        include_once("templates/" . $splitpageadmin[0] . ".php");
    else
        include_once("templates/404.php");
}
?>
