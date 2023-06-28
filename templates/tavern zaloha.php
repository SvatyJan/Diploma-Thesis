<?php
$itemy = Select("SELECT * FROM Items 
LEFT JOIN Characters_has_Items ON id_item = Characters_has_Items.Items_id_item 
LEFT JOIN Image ON Items.Image_id_image = Image.id_image
WHERE Characters_id_character = ?", $id, $conn);


$shopitemy = mysqli_query($conn,"SELECT * FROM Items 
LEFT JOIN Image ON Items.Image_id_Image = Image.id_image");

$shopitemstaty = mysqli_query($conn, "SELECT * FROM `items_has_stats` LEFT JOIN Stats ON Items_has_stats.Stats_id_stats = Stats.id_stats");

?>

<main class="main tavern">
<section class="tavern-playeritems">
    <?php
    foreach ($itemy as $item) {
        $imgsource = "icons/" . $item["source"];
        $itemid = $item["id_item"];
        $itemystaty = Select("SELECT * FROM Items_has_stats LEFT JOIN stats ON id_stats = Stats_id_stats WHERE Items_id_item = ?", $itemid, $conn);
        $itemvalue = $item["Value"];

        echo "<div class='profile-invenotory-item'>";
        if($itemid != 1){ echo "<a href='scripts/sellitem.php?itemid=$itemid&cost=$itemvalue'>";}
        if ($item["pocet"] > 1) {
            echo "<span class='profile-invenotory-item-counter'>" . $item["pocet"] . "</span>";
        }
        echo "<span class='profile-invenotory-item-counter'></span>";
        echo "<div class='tooltip'><img class='profile-invenotory-item-img' src='" . $imgsource . "' alt='" . $item["alt"] . "'>";
        echo "<span class='tooltiptext'>";
        echo $item["itemname"] . "<br>";
        foreach ($itemystaty as $itemstat) {
            $itemstatname = $itemstat["statname"];
            $itemstatvalue = $itemstat["value"];
            echo $itemstatname . " " . $itemstatvalue . "<br>";

        }
        echo "Cost <span class='tavern-itemvalue'>$itemvalue</span>";
        echo "</span>";
        echo "</div>";
        if($itemid != 1){echo "</a>";}
        echo "</div>";
    }
    ?>
</section>
<section class="tavern-shopitems">
    <?php
    foreach ($shopitemy as $iteminshop){
        $sitemid = $iteminshop["id_item"];
        $sitemicon = "icons/".$iteminshop["source"];
        $sitemname = $iteminshop["itemname"];
        $sitemvalue = $iteminshop["Value"];


        if($sitemid != 1){
        echo "<div class='tavern-invenotory-item'>";
        echo "<a href='scripts/buyitem.php?itemid=$sitemid&cost=$sitemvalue'>";
        echo "<div class='tooltip'><img class='tavern-invenotory-item-img' src='$sitemicon' height='128px' width='128px'>";
        echo "<span class='tooltiptext'>";
        echo "<b>$sitemname</b><br>";
        foreach ($shopitemstaty as $shopitemstat) {
            if ($shopitemstat["Items_id_item"] == $sitemid) {
                echo $shopitemstat["statname"] . " : " . $shopitemstat["value"] . "<br>";
            }
        }

        echo "Cost <span class='tavern-itemvalue'>$sitemvalue</span>";
        echo "</span>";
        echo "</div></a>";
        echo "</div>";
        }
    }
    ?>
</section>
</main>