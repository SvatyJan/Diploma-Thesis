<main class="main friends zarovnejnasted">

    <?php
    $id1 = $_SESSION['id'];

    $friends = Select("SELECT id_character,username FROM friends LEFT JOIN characters 
ON friends.Characters_id_character1 = characters.id_character AND friends.characters_id_character = ?",$id1,$conn);

    echo "<table style='font-family: arial, sans-serif;
  border-collapse: collapse;  width: 100%;'>
        <tr>
            <th>Id</th>
            <th>Username</th>
        </tr>";
    foreach ($friends as $friend){
        $friendid = $friend["id_character"];
        $friendname = $friend["username"];



    echo "<tr>
<td style='padding: 8px;'>$friendid</td>
<td><a href='index.php?pages=profile&id=$friendid'>$friendname</a></td>
</tr>";

    }
    echo "</table>";

    ?>


</main>