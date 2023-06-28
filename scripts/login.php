<?php
	include_once("../connect.php");
	$username 	= htmlspecialchars($_POST["username"]);
	$password 	= htmlspecialchars($_POST["password"]);
	$password 	= md5(htmlspecialchars($_POST["password"]));

	$vyber_hrace = mysqli_query($conn,"SELECT * FROM Characters WHERE username= '$username' AND password = '$password' LIMIT 1");
	$row_character = mysqli_fetch_assoc($vyber_hrace);
	$raceid = $row_character["Race_id_race"];
	$id = $row_character["id_character"];
	$vyber_rasu = mysqli_query($conn,"SELECT * FROM Race WHERE id_race = '$raceid'");
	$row_race = mysqli_fetch_assoc($vyber_rasu);

				if(mysqli_num_rows($vyber_hrace) > 0){
					@session_start();
					$_SESSION["login"] 				= $row_character["username"];
					$_SESSION["id"] 				= $id;
					$_SESSION["race"]				= $row_race["racename"];
					$_SESSION["rank"]               = $row_character["Rank_id_rank"];
					header("Location: ../index.php?pages=profile&id=$id");
				}
				else {
				header("Location: ../index.php");
				}
?>