<?php

echo "<div class='main'>";
echo "<table style='width:100%; text-align: center;'>";
echo "<tr>
    <th>id</th>
    <th>img</th>
    <th>Name</th>     
    <th>Level</th>
  </tr>";

$players = mysqli_query($conn, "SELECT id_character,username,Race_id_race,Image_id_image,source,alt FROM characters LEFT JOIN 
Image ON Image.id_image = characters.Image_id_image");

foreach ($players as $player) {
    $id = $player["id_character"];
    $username = $player["username"];
    $image = "icons/" . $player["source"];
    $alt = $player["alt"];

    $selectlevel = Select("SELECT * FROM characters_has_stats LEFT JOIN stats ON stats.id_stats = characters_has_stats.Stats_id_stats
         WHERE stats.statname = 'level' AND Characters_id_character = ?",$id,$conn)[0];
    ?>

    <tr>
    <td><?=$id?></td>
    <td><a href='index.php?pages=profile&id=<?= $id ?>'><img src='<?=$image?>' alt='<?=$alt?>' width='64px' height='64px'></td></a>
    <td><?=$username?></td>
    <td><?php if($selectlevel["statname"] === "level"){ echo $selectlevel["value"];} ?></td>
  </tr>

<?php
}
echo "</table>";
echo "</div>";


?>
