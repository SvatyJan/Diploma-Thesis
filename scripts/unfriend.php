<!DOCTYPE html>
<head>
    <title>BP Vývoj herní databáze</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<main class="main zarovnejnasted">
    <?php
    session_start();
    require("../connect.php");
    require("../functions.php");

    $myid = $_SESSION["id"];
    $hisid = $_GET["id"];

    if($myid == $hisid){
        echo "You can't unfriend yourself.<br>";
    }
    else{
//checkni jestli už ho máš v přátelích

        $ishefriend = "SELECT * FROM friends WHERE Characters_id_character = '$myid' AND Characters_id_character1 = '$hisid'";
        $resultishefriend = mysqli_query($conn,$ishefriend);

        if (mysqli_num_rows($resultishefriend) > 0) {
            // unfriend
            $deletefriend = mysqli_query($conn,"DELETE FROM `friends` WHERE Characters_id_character = $myid AND Characters_id_character1 = $hisid");
            echo "Your friend has been deleted.<br>";
        }
        else{
            echo "He is not your friend.<br>";

        }
    }
    echo "<a href='../index.php?pages=profile&id=$hisid'>Continue!</a>";
    ?>
</main>
